<div>
    <table class="table table-bordered mt-4 table-info">
        <thead class="custom-thead">
            <tr>
                <th scope="col" style="background-color: #031525;color: #439DF8; width:50px">ID</th>
                <th scope="col" style="background-color: #031525;color: #439DF8">Nome</th>
                <th scope="col" style="background-color: #031525;color: #439DF8">Descrição</th>
                <th scope="col" style="background-color: #031525;color: #439DF8;width: 70px;">Data</th>
                <th scope="col" style="background-color: #031525;color: #439DF8;width: 80px">Valor</th>
                <th scope="col" style="background-color: #031525;color: #439DF8;width: 80px">Tipo</th>
                <th scope="col" style="width: 100px; background-color: #031525;color: #439DF8;width:40px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if(count($financas) == 0)
                <tr>
                    <td colspan="7" class="text-center">Ainda não há registros</td>
                </tr>
            @else
                @foreach($financas as $financa)
                    <tr>
                        <td>{{ $financa->id }}</td>
                        <td>{{ $financa->nome }}</td>
                        <td>{{ $financa->descricao }}</td>
                        <td>{{ date('d/m/Y', strtotime($financa->data_despesa)) }}</td>
                        <td style="justify-content: right">{{ $financa->valor_formatado }}</td>
                        <td style="color:{{ $financa->class_tipo }}">{{ $financa->tipo }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-info d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#despesaModal{{ $financa->id }}" style="margin-right: 10px; width: 35px; height: 35px;">
                                <i class="fa-solid fa-pencil" style="color: white; font-size: 20px;"></i>
                            </button>
                            <div class="modal fade" id="despesaModal{{ $financa->id }}" tabindex="-1" aria-labelledby="despesaModalLabel{{ $financa->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="despesaModalLabel{{ $financa->id }}">Editar Despesa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="despesaForm{{ $financa->id }}" method="POST" action="{{ route('financas.update', $financa->id) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nome{{ $financa->id }}">Nome</label>
                                                    <input type="text" class="form-control" id="nome{{ $financa->id }}" name="nome" placeholder="Nome" value="{{ $financa->nome }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="descricao{{ $financa->id }}">Descrição</label>
                                                    <input type="text" class="form-control" id="descricao{{ $financa->id }}" name="descricao" placeholder="Descrição" value="{{ $financa->descricao }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="data{{ $financa->id }}">Data</label>
                                                    <input type="date" class="form-control" id="data{{ $financa->id }}" name="data" value="{{ $financa->data }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="valor{{ $financa->id }}">Valor</label>
                                                    <input type="number" class="form-control" id="valor{{ $financa->id }}" name="valor" placeholder="Valor" value="{{ $financa->valor }}" step="0.01">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tipo{{ $financa->id }}">Tipo</label>
                                                    <select class="form-select" name="tipo">
                                                        <option value="entrada" {{ $financa->tipo == 'entrada' ? 'selected' : '' }}>ENTRADA</option>
                                                        <option value="saida" {{ $financa->tipo == 'saida' ? 'selected' : '' }}>SAÍDA</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/financas/{{ $financa->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir o registro?');" class="d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center mt-3" style="margin-right: 10px;width: 35px; height: 35px;">
                                    <i class="fa-solid fa-trash" style="color: white; font-size: 20px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
</div>