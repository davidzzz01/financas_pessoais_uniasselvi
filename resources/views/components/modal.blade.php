<div>
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="despesaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="despesaModalLabel">Cadastrar Despesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="despesaForm" method="POST" action="{{ route('financas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input type="date" class="form-control" id="data" name="data">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" min="0">
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select class="form-select" name="tipo">
                                <option value="entrada">ENTRADA</option>
                                <option value="saida">SAÍDA</option>
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
</div>