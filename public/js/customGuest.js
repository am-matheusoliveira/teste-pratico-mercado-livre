// INPUT - [REMEMBER ME]
// Selecionando o checkbox pelo ID
const rememberMe = document.getElementById('remember_me');

// Selecionando o elemento que serão ocultado/exibido
const messageRememberMe = document.getElementById('message_remember_me');

// Verifica se os elementos rememberMe e messageRememberMe existem no DOM
if(rememberMe && messageRememberMe){
    
  // Adicionando um evento de clique no checkbox
  rememberMe.addEventListener('click', () => {
    // Alternar a classe 'invisible' no elemento alvo
    messageRememberMe.classList.toggle('hidden');
  });
}

// Função para visualizar ou remover a Foto de Perfil do Usuário - Cadastro/Edição
function picturePreview(){
  return {
    showPreview: (event) => {
      if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        document.getElementById('preview').src = src;
        
        // Remove o campo hidden "remove_picture" se o usuário escolher uma nova imagem
        const form = document.getElementById('profile-form');
        if(form){
          const hiddenField = form.querySelector('input[name="remove_picture"]');
          if(hiddenField) hiddenField.remove();
        }
      }
    },
    removePicture: () => {
      document.getElementById('preview').src = URLProfileIMG;
      document.getElementById('picture').value = '';
      
      const form = document.getElementById('profile-form');
      if(form){
        // Adiciona o input hidden remove_picture se não existir
        if(!form.querySelector('input[name="remove_picture"]')){
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'remove_picture';
          input.value = 'true';
          form.appendChild(input);
        }
      }
    }
  }
}

// Impede o usuário de fazer upload de arquivos maior que 3MB
const pictureSignupForm = document.getElementById('picture');
if(pictureSignupForm){
  pictureSignupForm.addEventListener('change', function () {
    const file = this.files[0];
    const errorMessage = document.getElementById('upload-error');
    const preview = document.getElementById('preview');
    
    // Validando o tamanho do arquivo
    if(file && file.size > 3 * 1024 * 1024){
      // Mostrando o erro e limpando o(s) campo(s)
      errorMessage.classList.remove('hidden');
      preview.src = URLProfileIMG;
      //
      this.value = '';
    }else{
      // Escondendo o erro caso um arquivo válido for escolhido
      errorMessage.classList.add('hidden');
    }
  });
}