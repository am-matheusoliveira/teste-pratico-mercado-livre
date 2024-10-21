<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        // Migration produtos
        Schema::create('produto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255)->nullable(false);
            $table->text('descricao')->nullable(false);
            $table->decimal('preco', 10, 2)->nullable(false);
            $table->integer('quantidade')->nullable(false);
            $table->string('categoria', 100)->nullable(false);
            $table->string('imagem', 255)->nullable(false);
            $table->timestamp('data_cadastro')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable(false);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
