<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de categoria donativos</h3>

              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  agregar nuevo
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id Actividad</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Descripcion</th>
                    <th>Cantidad Participantes</th>
                    <th>Imagen</th>
                    <th>Lista Participantes</th>
                    <th>Id Voluntarios</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="Actividad in Actividad.data"
                    :key="Actividad.id"
                    >
                    <td>{{ Actividad.id }}</td>
                    <td class="text-capitalize">{{ Actividad.nombre }}</td>
                    <td class="text-capitalize">{{ Actividad.fecha }}</td>
                    <td class="text-capitalize">{{ Actividad.hora }}</td>
                    <td class="text-capitalize">{{ Actividad.descripcion }}</td>
                    <td class="text-capitalize">{{ Actividad.cantParticipantes }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/Actividades/' + Actividad.imagen"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td class="text-capitalize">{{ Actividad.listaParticipantes }}</td>
                    <td class="text-capitalize">{{ Actividad.idvoluntarios }}</td>
                    <td>
                      <a href="#" @click="editModal(Actividad)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarCatDonativo(Actividad.id)">
                        <i class="fa fa-trash red"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination
                :data="Actividad"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div v-if="!$gate.isAdmin()">
        <not-found></not-found>
      </div>

      <!-- Modal -->
      <div
        class="modal fade"
        id="addNew"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addNew"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-show="!editmode">
                Crear nueva Actividad
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar Actividad
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form
              @submit.prevent="
                editmode ? actualizarCatDonativo() : crearCatDonativo()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>

                <div class="form-group">
                  <label>Fecha</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>

                <div class="form-group">
                  <label>Hora</label>
                  <input
                    v-model="form.hora"
                    type="time"
                    name="hora"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('hora') }"
                  />
                  <has-error :form="form" field="hora"></has-error>
                </div>


                <div class="form-group">
                  <label>Descripcion</label>
                  <input
                    v-model="form.descripcion"
                    type="text"
                    name="Descripcion"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('descripcion') }"
                  />
                  <has-error :form="form" field="descripcion"></has-error>
                </div>

                <div class="form-group">
                  <label>Cantidad Participantes</label>
                  <input
                    v-model="form.cantParticipantes"
                    type="number"
                    name="cantParticipantes"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('cantParticipantes') }"
                  />
                  <has-error :form="form" field="cantParticipantes"></has-error>
                </div>

                <div class="form-group">
                  <label for="photo" class="col-sm-2 control-label"
                    >Imagen</label
                  >
                  <div class="custom-file">
                    <input
                      type="file"
                      @change="updatePhoto"
                      name="imagen"
                      class="custom-file-input"
                      id="inputGroupFile01"
                    />
                    <label class="custom-file-label" for="inputGroupFile01"
                      >Seleccione un imagen</label
                    >
                  </div>

                  <div class="form-group">
                  <label>Lista Participantes</label>
                  <input
                    v-model="form.listaParticipantes"
                    type="text"
                    name="listaParticipantes"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('listaParticipantes') }"
                    />
                    <has-error :form="form" field="listaParticipantes"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Id Voluntarios</label>
                    <input
                      v-model="form.idvoluntarios"
                      type="number"
                      name="idvoluntario"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('idvoluntarios') }"
                    />
                    <has-error :form="form" field="idVoluntarios"></has-error>
                  </div>
                </div>
              </div>


              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cerrar
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Actualizar
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                >
                  Crear
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      Actividad: {},
      form: new Form({
        id:"",
        nombre: "",
        fecha: "",
        hora: "",
        descripcion:"",
        cantParticipantes: "",
        imagen:"",
        listaParticipantes:"",
        idvoluntarios:"",
      }),
    };
  },
   methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      let reader = new FileReader();

      if (file["size"] < 2111775) {
        reader.onloadend = (file) => {
          //console.log('RESULT', reader.result)
          this.form.imagen = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        swal({
          type: "error",
          title: "ops...",
          text: "archivo muy grande",
        });
      }
    },
    getTraerVoluntariosId(){
          axios.get("/api/actividad/obtenerVoluntarios").then(response =>{
                console.log(response);
          });
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/actividad?page=" + page)
        .then(({ data }) => (this.Actividad = data.data));
      this.$Progress.finish();
    },
    actualizarCatDonativo() {
      this.$Progress.start();
      this.form
        .put("/api/actividad/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarCatDonativos();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(catdonativo) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(catdonativo);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    cargarCatDonativos() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/actividad")
          .then(({ data }) => (this.Actividad = data.data));
      }
    },

    crearCatDonativo(){
      this.$Progress.start();
      this.form
        .post("/api/actividad")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarCatDonativos();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    eliminarCatDonativo(id) {
      Swal.fire({
        title: "Seguro que lo desea eliminar?",
        text: "Esta acción no puede revertirse!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("/api/actividad/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarCatDonativos();
            })
            .catch((data) => {
              Swal.fire("Fallo!", data.message, "warning");
            });
        }
      });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
  eliminarCatDonativo(id) {},

  created() {
    this.$Progress.start();
    this.cargarCatDonativos();
    this.getTraerVoluntariosId();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
};
</script>

<style>

</style>