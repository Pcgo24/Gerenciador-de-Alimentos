@extends('layouts.app')

@section('content')
    <h1>Lista de Alimentos</h1>

    @if(session('sucesso'))
        <p style="color: green;">{{ session('sucesso') }}</p>
    @endif

    <a href="{{ route('alimentos.index') }}">Voltar ao ínicio</a>
    <a href="{{ route('alimentos.create') }}">Adicionar Novo Alimento</a>
    <a href="{{ route('alimentos.index', ['validade_proxima' => true]) }}">Ver alimentos com validade próxima</a>

    <ul>
        @foreach($alimentos as $alimento)
            <li>
                <strong>{{ $alimento->nome }}</strong> -
                Quantidade: {{ $alimento->quantidade }}
                @if($alimento->quantidade <= 3)
                    <span style="color: red;">(Estoque baixo!)</span>
                @endif
                - Validade: {{ $alimento->validade ?? 'Sem validade' }}
                <a href="{{ route('alimentos.edit', $alimento) }}">Editar</a>
                <form action="{{ route('alimentos.destroy', $alimento) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>


@endsection
