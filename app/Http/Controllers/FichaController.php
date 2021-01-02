<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\Periodico;
use Illuminate\Http\Request;
use App\Http\Controllers\BibliowebController;

class FichaController extends BibliowebController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$mensagem = request()->mensagem ?? '';
		$periodicos = Periodico::all();
		$fichas = Ficha::orderBy('updated_at', 'desc')->get();
		return view('conteudo.admin-fichas')
			->with(['fichas' => $fichas])
			->with(['periodicos' => $periodicos])
			->with(['mensagem' => $mensagem]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$ficha = new Ficha;
		$ficha->assunto = $request->assunto;
		$ficha->periodico_id = $request->periodico;
		$ficha->data_edicao = \Carbon\Carbon::parse($request->data_edicao);
		$ficha->duracao_edicao = \Carbon\Carbon::parse($request->duracao_edicao);
		$ficha->pagina = $request->pagina;
		$ficha->resumo = $request->resumo;
		$ficha->comentario = $request->comentario;
		$ficha->edicao = $request->edicao;
		$mensagem = null;
		$mensagem = $ficha->save() ? 'store' : 'store-error';

		return redirect()->route('ficha.create', ['mensagem' => $mensagem]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Ficha  $ficha
	 * @return \Illuminate\Http\Response
	 */
	public function show(Ficha $ficha)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Ficha  $ficha
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Ficha $ficha)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Ficha  $ficha
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Ficha $ficha)
	{
		$ficha->assunto = $request->assunto;
		$ficha->periodico_id = $request->periodico;
		$ficha->data_edicao = $request->data_edicao;
		$ficha->duracao_edicao = $request->duracao_edicao;
		$ficha->pagina = $request->pagina;
		$ficha->resumo = $request->resumo;
		$ficha->comentario = $request->comentario;
		$ficha->edicao = $request->edicao;
		$mensagem = null;
		$mensagem = $ficha->save() ? 'update' : 'update-error';

		return redirect()->route('ficha.create', ['mensagem' => $mensagem]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Ficha  $ficha
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Ficha $ficha)
	{
		$mensagem = $ficha->delete() ? 'destroy' : 'destroy-error';
		return redirect()->route('ficha.create', ['mensagem' => $mensagem]);
		//
	}
}
