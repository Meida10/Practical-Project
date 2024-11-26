<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;

class ResponderMensagemController extends Controller
{
    public function responder($id)
    {
        // Recuperar a mensagem com base no ID fornecido na rota
        $contato = Contato::findOrFail($id);

        // Exibir um formulário de resposta na view associada
        return view('admin.responder_mensagem', compact('contato'));
    }

    public function enviarResposta(Request $request, $id)
    {
        // Validar os dados do formulário de resposta
        $request->validate([
            'resposta' => 'required|string',
        ]);

        // Recuperar a mensagem com base no ID fornecido na rota
        $contato = Contato::findOrFail($id);

        // Salvar a resposta no banco de dados
        $contato->resposta = $request->input('resposta');
        $contato->save();

        // Notificar o usuário, se necessário (você pode adicionar lógica de notificação aqui)

        // Redirecionar de volta para a página de listagem de mensagens ou outra página adequada
        return redirect()->route('admin.mensagens.index')->with('success', 'Resposta enviada com sucesso!');
    }
}
