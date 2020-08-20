<template>
  <div class="m-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Função</th>
          <th scope="col">Salário</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(f, index) in listaFuncionarios" :key="index">
          <th scope="row">{{f.id}}</th>
          <td>{{f.nome}}</td>
          <td>{{f.funcao}}</td>
          <td>R$ {{f.salario}}</td>
          <td>
            <button
              class="btn btn-warning btn-sm"
              data-toggle="modal"
              data-target="#modalFuncionario"
              @click="carregarFuncionario(f)"
            >Editar</button>
            <button class="btn btn-danger btn-sm" @click="excluirFuncionario(f.id)">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- modal para editar Funcionário -->
    <div
      class="modal fade"
      id="modalFuncionario"
      tabindex="-1"
      aria-labelledby="modalFuncEdit"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalFuncEdit">Editar Funcionário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formFuncionario">
            <div class="modal-body">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nome"
                  name="nome"
                  id="nome"
                  v-model="nomeFunc"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Função"
                  name="funcao"
                  id="funcao"
                  v-model="funcao"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Salário"
                  name="salario"
                  id="salario"
                  v-model="salario"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-warning" @click="editarFuncionario()">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    let listaFuncionarios;
    //carregando a lista de funcionários
    this.$http
      .get("http://localhost:8000/api/funcionarios")
      .then((response) => {
        this.listaFuncionarios = response.body;
      });
    return {
      listaFuncionarios,
      nomeFunc: null,
      funcao: null,
      salario: null,
      idFuncionario: null,
      funcionario: null,
    };
  },
  methods: {
    carregarFuncionario(func) {
      this.idFuncionario = func.id;
      this.nomeFunc = func.nome;
      this.funcao = func.funcao;
      this.salario = func.salario;
      this.funcionario = func;
    },
    editarFuncionario() {
      let func = {
        nome: this.nomeFunc,
        funcao: this.funcao,
        salario: this.salario,
      };
      this.$http
        .put(
          "http://localhost:8000/api/funcionarios/" + this.idFuncionario,
          func
        )
        .then(
          (response) => {
            alert("edição feita com sucesso!");
            this.funcionario.nome = this.nomeFunc;
            this.funcionario.funcao = this.funcao;
            this.funcionario.salario = this.salario;
          },
          (response) => {
            alert("erro ao editar");
          }
        );
    },
    excluirFuncionario(id) {
      //apagando no servidor.
      this.$http.delete("http://localhost:8000/api/funcionarios/" + id).then(
        (response) => {
          alert("excluido com sucesso");
          //apagando na lista.
          for (let i = 0; i < this.listaFuncionarios.length; i++) {
            if (this.listaFuncionarios[i].id == id) {
              this.listaFuncionarios.splice(i, 1);
              return;
            }
          }
        },
        (response) => {
          alert("erro ao excluir");
        }
      );
    },
  },
};
</script>

<style>
</style>