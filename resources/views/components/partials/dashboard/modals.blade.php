<style>
  @media screen and (min-width: 1200px) {
    .modal-xl {
      max-width: 90%;
    }
  }
</style>
<div class="container">

  <!-- The Modal -->
  <div class="modal fade" id="modalTicketsCreated">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chamados Criados</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
          <table class="table data-table table-striped dt-responsive" width="100%" id="tableTicketsCreated">
            <thead>
              <tr>
                <th>Chamado</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Assunto</th>
                <th>Status do chamado</th>
                <th>Data da Última atualização</th>
                <th>Status da ultima movimentação</th>
                <th>Data do Envio</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal fade" id="modalTicketsClosed">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chamados Fechados</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
          <table class="table data-table table-striped dt-responsive" id="tableTicketsClosed" >
            <thead>
              <tr>
                <th>Chamado</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Assunto</th>
                <th>Status do chamado</th>
                <th>Data da Última atualização</th>
                <th>Status da ultima movimentação</th>
                <th>Data do Envio</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal fade" id="modalTicketsOpened">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chamados Abertos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
          <table class="table data-table table-striped dt-responsive" id="tableTicketsOpened" >
            <thead>
              <tr>
                <th>Chamado</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Assunto</th>
                <th>Status do chamado</th>
                <th>Data da Última atualização</th>
                <th>Status da ultima movimentação</th>
                <th>Data do Envio</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar email</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal fade" id="modalTicketsReopened">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chamados Reabertos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
          <table class="table data-table table-striped dt-responsive" id="tableTicketsReopened" >
            <thead>
              <tr>
                <th>Chamado</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Assunto</th>
                <th>Status do chamado</th>
                <th>Data da Última atualização</th>
                <th>Status da ultima movimentação</th>
                <th>Data do Envio</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar email</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal fade" id="modalTicketsTransferred">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chamados Transferidos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
          <table class="table data-table table-striped dt-responsive" id="tableTicketsTransferred" >
            <thead>
              <tr>
                <th>Chamado</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Assunto</th>
                <th>Status do chamado</th>
                <th>Data da Última atualização</th>
                <th>Status da ultima movimentação</th>
                <th>Data do Envio</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar email</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal fade" id="modalTicketsOverdue">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chamados Atrasados</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
          <table class="table data-table table-striped dt-responsive" id="tableTicketsOverdue" >
            <thead>
              <tr>
                <th>Chamado</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Assunto</th>
                <th>Status do chamado</th>
                <th>Data da Última atualização</th>
                <th>Status da ultima movimentação</th>
                <th>Data do Envio</th>
              </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar email</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

</div>