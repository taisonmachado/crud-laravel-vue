<template>
  <div>
    <div class="mt-5 d-flex justify-content-around">
      <button
        class="btn btn-primary btn-cadastro mr-5"
        data-toggle="modal"
        data-target="#modalFuncionario"
      >Cadastrar Funcionário</button>
      <button
        class="btn btn-primary btn-cadastro"
        data-toggle="modal"
        data-target="#modalDepartamento"
      >Cadastrar Departamento</button>
    </div>


    <!-- Modal para o cadastro de Funcionários -->
    <div
      class="modal fade"
      id="modalFuncionario"
      tabindex="-1"
      aria-labelledby="modalFunc"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalFunc">Cadastro de Funcionário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
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
            <button type="button" class="btn btn-success" @click="addFuncionario">Cadastrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para o cadastro de Departamentos -->
    <div
      class="modal fade"
      id="modalDepartamento"
      tabindex="-1"
      aria-labelledby="modalDep"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDep">Cadastro de Departamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                placeholder="Nome"
                name="nomeDep"
                id="nomeDep"
                v-model="nomeDep"
              />
            </div>
            <div class="form-group">
              <textarea
                rows="3"
                placeholder="Descrição"
                class="form-control"
                name="descricao"
                id="descricao"
                v-model="descricao"
              ></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" @click="addDepartamento">Cadastrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nomeFunc: null,
      funcao: null,
      salario: null,
      descricao: null,
      nomeDep: null,
    };
  },
  methods: {
    addFuncionario() {
      let funcionario = {
        nome: this.nomeFunc,
        funcao: this.funcao,
        salario: this.salario,
      };
      this.$http
        .post("http://localhost:8000/api/funcionarios", funcionario)
        .then(
          (response) => {
            alert("cadastro feito!");
            this.nomeFunc = "";
            this.funcao = "";
            this.salario = "";
          },
          (response) => {
            alert("erro no cadastro");
          }
        );
    },
    addDepartamento() {
      let departamento = {
        nome: this.nomeDep,
        descricao: this.descricao,
      };
      this.$http
        .post("http://localhost:8000/api/departamentos", departamento)
        .then(
          (response) => {
            alert("cadastro feito!");
            this.nomeDep = "";
            this.descricao = "";
          },
          (response) => {
            alert("erro no cadastro");
          }
        );
    },
  },
};
</script>

<style>
.btn-cadastro {
  width: 400px;
  height: 80px;
  font-size: 22px;
}
</style>