<template>
  <div class="m-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Descrição</th>
          <th scope="col">Ações</th>
          <th scope="col">Funcionários</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(dep, index) in listaDepartamentos" :key="index">
          <th scope="row">{{dep.id}}</th>
          <td>{{dep.nome}}</td>
          <td>{{dep.descricao}}</td>
          <td>
            <button
              class="btn btn-danger btn-sm"
              @click="excluirDepartamento(dep.id)"
            >Excluir Departamento</button>
          </td>
          <td>
            <button
              class="btn btn-primary btn-sm mb-1"
              data-toggle="modal"
              data-target="#modalFuncionario"
              @click="carregarFuncionarios(dep.id)"
            >Incluir Funcionário</button>
            <button
              class="btn btn-info btn-sm"
              data-toggle="modal"
              data-target="#modalFuncionarioDep"
              @click="exibirFuncionarios(dep.funcionarios)"
            >Exibir Funcionários</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- modal para adicionar funcionários ao departamento -->
    <div
      class="modal fade"
      id="modalFuncionario"
      tabindex="-1"
      aria-labelledby="modalFuncDep"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalFuncDep">Adicionar Funcionário ao Departamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formFuncionario">
            <div class="modal-body">
              <div class="form-group">
                <label for="funcionario">Nome do Funcionário</label>
                <select class="form-control" id="funcionario" v-model="idFuncionario">
                  <option v-for="f in listaFuncionarios" :key="f" :value="f.id">{{f.nome}}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button
                type="button"
                class="btn btn-warning"
                @click="addFuncionarioDepartamento()"
              >Adicionar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- modal para mostrar funcionarios de determinado departamento -->
    <div
      class="modal fade"
      id="modalFuncionarioDep"
      tabindex="-1"
      aria-labelledby="modalDepFunc"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDepFunc">Funcionários do Departamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Função</th>
                  <th scope="col">Salário</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(f, index) in listaFuncionariosDep" :key="index">
                  <th scope="row">{{f.id}}</th>
                  <td>{{f.nome}}</td>
                  <td>{{f.funcao}}</td>
                  <td>R$ {{f.salario}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    let listaDepartamentos;
    let listaFuncionarios;
    let listaFuncionariosDep;
    //carregando lista de departamentos
    this.$http
      .get("http://localhost:8000/api/departamentos")
      .then((response) => {
        this.listaDepartamentos = response.body;
      });
    return {
      listaDepartamentos,
      listaFuncionarios,
      listaFuncionariosDep,
      idFuncionario: null,
      idDepartamento: null,
    };
  },
  methods: {
    carregarFuncionarios(idDep) {
      this.idDepartamento = idDep;
      this.$http.get("http://localhost:8000/api/funcionarios").then(
        (response) => {
          this.listaFuncionarios = response.body;
        },
        (response) => {
          alert("erro ao carregar funcionários");
        }
      );
    },
    //Aloca um funcionário a um departamento
    addFuncionarioDepartamento() {
      let alocacao = {
        funcionario_id: this.idFuncionario,
        departamento_id: this.idDepartamento,
      };
      this.$http.post("http://localhost:8000/api/alocar", alocacao).then(
        (response) => {
          alert("funcionário adicionado");
        },
        (response) => {
          alert("erro ao adicionar");
        }
      );
    },
    exibirFuncionarios(funcionarios) {
      this.listaFuncionariosDep = funcionarios;
    },
    excluirDepartamento(id) {
      this.$http.delete("http://localhost:8000/api/departamentos/" + id).then(
        (response) => {
          alert("departamento exlcuído");
          for (let i = 0; i < this.listaDepartamentos.length; i++) {
            if (this.listaDepartamentos[i].id == id) {
              this.listaDepartamentos.splice(i, 1);
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