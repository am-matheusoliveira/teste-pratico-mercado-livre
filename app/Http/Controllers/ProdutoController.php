<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Produto;
use Exception;

class ProdutoController extends Controller
{   
    /**
     * Status da Mensagem
     */
    private string $status = '';

    /**
     * Mensagem Genérica
     */
    private string $message = '';

    /**
     * Mensagem que será enviada
     */
    private string $msgDescricao = '';

    /**
     * Método responsável por retornar o usuário a página de cadastro de produtos
     */
    public function index(){
        // Variável que armazena o valor do Token
        $tokenAPI = '';

        // Variável que armazena o estado dos inputs
        $inputStatus = 'disabled';

        // Verificando se a variável de sessão 'tokenAPI' existe
        if(session()->has('tokenAPI')){
            // Pegando o valor da variável
            $tokenAPI = session('tokenAPI');

            // Alterando o status do inputs 
            $inputStatus = '';
        }

        // Fazendo a requisição GET para a API do Mercado Livre que contém as Categorias
        $response = Http::withOptions(['verify' => false])->get('https://api.mercadolibre.com/categories/MLB22739');

        // Convertendo a resposta JSON para um array associativo
        $categorias = $response->json();
        
        // Retornando um array de categorias e demais variáveis para visualização na view
        return view('produto', ['categorias' => $categorias, 'tokenAPI' => $tokenAPI, 'inputStatus' => $inputStatus]);        
    }

    /**
     * Método responsavel por salvar o produto no Banco de Dados e no Mercado Livre
     * @param Request $request
     */
    public function cadastrarProduto(Request $request){

        try{
            // Verificando se uma imagem foi enviada
            if ($request->hasFile('input-imagem')) {

                // Salvando imagem na varia
                $imagem = $request->file('input-imagem');
    
                // Armazenamento da imagem na pasta Local
                $imagem->store('produtos', 'public');
    
                // Upload da imagem para o serviço Imgbb
                $imagePath = $imagem->getRealPath();

                // Convertendo a imagem no formato esperado pelo serviço
                $imageData = base64_encode(file_get_contents($imagePath));
    
                // Fazendo o upload para o Imgbb
                $responseImgbb = Http::withoutVerifying()->asForm()->post('https://api.imgbb.com/1/upload', [
                    'key' => env('IMGBB_API_KEY'),
                    'image' => $imageData,
                ]);
                
                // Pegando a URL gerada pelo ImgBB
                $caminhoImagem = $responseImgbb->json('data.url');
            } else {
                $caminhoImagem = null;
            }
            
            // Removendo a mascara do campo preço
            $inputPreco = (empty($request->input('input-preco')) ? '0.00' : str_replace(',', '.', str_replace('.', '', $request->input('input-preco'))));
    
            // Obtendo o Token da Sessão
            $token = session('tokenAPI');            

            // URL da API de produtos do Mercado Livre
            $url = 'https://api.mercadolibre.com/items';
    
            // Corpo da requisição com os dados do produto
            $dadosProduto = [
                "title"              => $request->input('input-nome'),
                "category_id"        => $request->input('select-categoria'),
                "price"              => $inputPreco,
                "currency_id"        => "BRL",
                "available_quantity" => $request->input('input-quantidade'),
                "buying_mode"        => "buy_it_now",
                "listing_type_id"    => "gold_special",
                "condition"          => "new",
                "description"        => [
                    "plain_text" => $request->input('input-descricao')
                ],
                "pictures" => [
                    [
                        "source" => $caminhoImagem
                    ]
                ],
                "attributes" => [
                    [
                        "id" => "BRAND",
                        "value_name" => "Marca Mercado"
                    ],
                    [
                        "id" => "MODEL",
                        "value_name" => "Modelo Mercado"
                    ],
                    [
                        "id" => "RECOMMENDED_AMBIENTS",
                        "value_name" => "Ambiente recomendado"
                    ]
                ]
            ];
            
            // Fazer o POST na API com o token de autenticação
            $response = Http::withoutVerifying()->withToken($token)->post($url, $dadosProduto);

            // Verificando se o POST obteve Sucesso
            if(!isset($response['cause'][0])){
                // Criando um novo produto com os dados do request
                $produto = new Produto;
                $produto->nome       = $request->input('input-nome');
                $produto->descricao  = $request->input('input-descricao');
                $produto->preco      = $inputPreco;
                $produto->quantidade = $request->input('input-quantidade');
                $produto->categoria  = $request->input('select-categoria');
                $produto->imagem     = $caminhoImagem;
                
                // Salva o produto no banco de dados
                $produto->save();

                // Retornando mensagem
                $this->mensagemRetorno(
                    'success',
                    'Produto cadastrado com sucesso!',
                    'Acesse o produto cadastro no Mercado Livre.'
                );
            }else{
                // Retornando mensagem
                $this->mensagemRetorno(
                    'error',
                    'Erro ao cadastrar o produto!',
                    'Houve algum erro ao realizar o cadastro deste produto no Mercado Livre. <br> <br> Mercado Livre: '.$response['cause'][0]['message']
                );
            }
    
        }catch (Exception $e){
            // Retornando mensagem
            $this->mensagemRetorno(
                'error',
                'Erro ao cadastrar o produto!',
                'Houve algum erro ao realizar o cadastro deste produto no Mercado Livre.'
            );
        }

        // Redireciona para a página inicial
        return redirect('/produto')->with($this->status, $this->message)->with('msgDescricao', $this->msgDescricao)->with('response', $response->json());
    }

    /**
     * Método responsável por gerar o token de autenticação da API com base no parâmetro 'code'
     * @param Request $request
     */
    public function gerarToken(Request $request){
        try{
            // 'code' parâmetro que veio na queryString do Mercado Livre
            $code = $request->query('code');
            
            // Gerando o token de autenticação da API atraves do endpoint /oauth/token
            $response = Http::withoutVerifying()->post('https://api.mercadolibre.com/oauth/token', [
                'grant_type'    => 'authorization_code',
                'client_id'     => env('CLIENT_ID'),
                'client_secret' => env('SECRET_KEY'),
                'code'          => $code,
                'redirect_uri'  => env('REDIRECT_URI'),
            ]);

            // Armazenando o token na sessão
            session(['tokenAPI' => $response->json()['access_token']]);

            // Retornando mensagem
            $this->mensagemRetorno(
                'success', 
                'Token Gerado com sucesso!', 
                'Agora você pode realizar o cadastro de produtos com seu Token Gerado!'
            );
        }catch (Exception $e){
            // Retornando mensagem
            $this->mensagemRetorno(
                'error', 
                'Erro ao Gerar Token!', 
                'Holve algum erro durante a criação do Token para acesso as APIs!'
            );
        }
    
        // Redireciona para a página inicial
        return redirect('/produto')->with($this->status, $this->message)->with('msgDescricao', $this->msgDescricao);
    }

    /**
     * Método responsável por retornar mensagens personalizadas para o FrontEnd
     * @param string $status
     * @param string $message
     * @param string $msgDescricao
     */
    public function mensagemRetorno($status, $message, $msgDescricao){
        // Status da Mensagem
        $this->status = $status;
    
        // Mensagem Genérica
        $this->message = $message;
        
        // Mensagem que será enviada
        $this->msgDescricao = $msgDescricao;
    }
}
