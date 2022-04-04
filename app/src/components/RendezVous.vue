<template>
<div>   
     <h1 class="text-center">Gestion des rendez-vous d'un cabinet dentaire</h1>

<div class="container">
    <!-- show add rdv -->
    <div class="col-lg-12">
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <FIcon :icon="['far','calendar']" />   Add new rdv
        </button>

        <button  type="button" class="float-start btn btn-danger" data-bs-toggle="modal" data-bs-target="#Examplesss" v-if="RdvData.length > 0" >   Delete All rdv
            <FIcon :icon="['far','calendar-times']" />
        </button>

        <div class="clearfix"></div>
    </div>
    <hr class="bg-info">
    <!-- show error message -->
    <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="errMsg">
        {{errMsg}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">
        </button>
    </div> -->

    <!-- show success message -->
<!--     
     <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="successMsg">
        {{successMsg}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">
        </button>
    </div> -->

    <!-- show rdv details : table -->
    <table class="table table-border table-striped caption-top" v-if="app">
        <caption>
            List of Rdv <!--({{ RdvData.length }}) -->
        </caption>
        <thead>
            <tr class="bg-dark text-light text-center">
                <th><FIcon :icon="['far','id-card']" /> RDV ID</th>
                <th><FIcon :icon="['fas','tasks']" /> Subject</th>
                <th><FIcon :icon="['far','calendar']" />Date</th>
                <th><FIcon :icon="['far','address-card']" /> Time</th>
                <th><FIcon :icon="['far','address-card']" /> Status</th>
                <th><FIcon :icon="['fas','cog']" />  Actions</th>
            </tr>
            </thead>
                <tbody>

                    <tr class="text-center" v-for="(rdv, index) in rdvs_obj"
          :key="rdv.rdv_id">
                        <td>{{ index + 1 }}</td>
          <td>{{ rdv.patient_subject }}</td>
          <td>{{ rdv.c_date }}</td>
          <td>{{ rdv.start_at }} - {{ rdv.end_at }}</td>
          <td>{{ rdv.rdv_id }}</td>
          <td>
            <button type="button" class="btn text-danger " data-bs-toggle="modal" data-bs-target="#Exampless"> <FIcon :icon="['fas','user-times']" /> </button> <br>
            <button type="button" class="btn text-success " data-bs-toggle="modal" data-bs-target="#examples">
                    <FIcon :icon="['fas','user-edit']" /> </button>
        </td>
                    </tr>
                </tbody>
        
    </table>
     <p v-else>There are no RDVs</p>
    <!-- show add new rdv modal -->

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new rdv </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="post" @submit.prevent="BookARDV">
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.newRdv.sujetR.$error}"> -->
         <label class="form_label" for="subject">Enter Your Subject</label>
          <input type="text" name="sujet" id="sujetfloat" class="form-control"  v-model="subject">
          <!-- <span class="error-feedback" v-if="v$.newRdv.sujetR.$error">
        {{v$.newRdv.sujetR.$errors[0].$message}}
         </span> -->
          <!-- </div> -->
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.newRdv.dateC.$error}"> -->
        <label class="form_label" for="date">Enter your date</label>
          <input type="date" name="dateC" id="datefloat" class="form-control my-3" v-model="RDVDate"
          :min="TodayDate()"
          @change="getAvailableTimes">
           <!-- <span class="error-feedback" v-if="v$.newRdv.dateC.$error">
        {{v$.newRdv.dateC.$errors[0].$message}}
         </span> -->
        <!-- </div> -->
         <!-- <div class="form-floating" :class="{'form-group-error' : v$.newRdv.creneau.$error}"> -->
        <select class="form-select" aria-label="Default select example" v-model="creneau">>
         <option value="" selected hidden>choose a creneau</option>
          <option
            v-for="(creneau, index) in creneau_obj"
            :value="creneau.creneau_id"
            :key="index"
            >{{ creneau.start_at }} - {{ creneau.end_at }}
          </option>
        </select>     
         <!-- <span class="error-feedback" v-if="v$.newRdv.creneau.$error">
        {{v$.newRdv.creneau.$errors[0].$message}}
         </span> -->
         <!-- </div> -->
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-primary">Add rdv</button>
        </div>
        </form>
        </div>
        
        </div>
    </div>
    </div>
    <!-- show edit rdv modal -->

    <!-- Modal -->

    <div class="modal fade" id="examples" tabindex="-1" aria-labelledby="exemple" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exemple">Update rdv </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="#" method="post" @submit.prevent="BookARDV">
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.newRdv.sujetR.$error}"> -->
         <label class="form_label" for="subject">Enter Your Subject</label>
          <input type="text" name="sujet" id="sujetfloat" class="form-control"  v-model="subject">
          <!-- <span class="error-feedback" v-if="v$.newRdv.sujetR.$error">
        {{v$.newRdv.sujetR.$errors[0].$message}}
         </span> -->
          <!-- </div> -->
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.newRdv.dateC.$error}"> -->
        <label class="form_label" for="date">Enter your date</label>
          <input type="date" name="dateC" id="datefloat" class="form-control my-3" v-model="RDVDate"
          :min="TodayDate()"
          @change="getAvailableTimes">
           <!-- <span class="error-feedback" v-if="v$.newRdv.dateC.$error">
        {{v$.newRdv.dateC.$errors[0].$message}}
         </span> -->
        <!-- </div> -->
         <!-- <div class="form-floating" :class="{'form-group-error' : v$.newRdv.creneau.$error}"> -->
        <select class="form-select" aria-label="Default select example" v-model="creneau">>
         <option value="" selected hidden>choose a creneau</option>
          <option
            v-for="(creneau, index) in creneau_obj"
            :value="creneau.creneau_id"
            :key="index"
            >{{ creneau.start_at }} - {{ creneau.end_at }}
          </option>
        </select>     
         <!-- <span class="error-feedback" v-if="v$.currentRdv.time.$error">
        {{v$.currentRdv.time.$errors[0].$message}}
         </span> -->
         <!-- </div> --> 
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updateARDV(rdv.rdv_id)">Update rdv</button>
        </div>
        </form>
        </div>
       
        </div>
    </div>
    </div>
    <!-- show delete rdv modal-->

    
    <!-- Modal -->

    <div class="modal fade" id="Exampless" tabindex="-1" aria-labelledby="Exemplee" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="Exemplee">Delete rdv </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="post" @click.prevent>
                <h6 class="text-center"> Are you sure, you want to delete this rdv?</h6><br>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"  @click="deleteARDV(rdv.rdv_id)" >
                Delete rdv</button>
        </div>
        </form>
        </div>
       
        </div>
    </div>
    </div>
    <!-- show delete all rdv -->
    
      
    <!-- Modal -->

    <div class="modal fade" id="Examplesss" tabindex="-1" aria-labelledby="Exempleee" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="Exempleee">Delete all rdv </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="post" @click.prevent>
                <h6 class="text-center"> Are you sure, you want to delete all rdv?</h6><br>
                
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="deleteAllRdv()">Delete all rdv</button>
        </div>
        </form>
        </div>
        </div>
    </div>
    </div>
</div>
</div>
</template>

<script>
import axios from 'axios';
// import useValidate from "@vuelidate/core";
// import {required, minLength} from "@vuelidate/validators";
export default {
     data() {
    return {
      patientId: "",
      date: "",
      obj: "",
      creneaux: "",
      creneau: "",
      RDVDate: "",
      subject: "",
      creneaux_obj: {},
      today: "",

      rdvs_obj: {},
      patient_personal_informations: {},
      app: false
    };
  },
    methods: {
    TodayDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, "0");
      var mm = String(today.getMonth() + 1).padStart(2, "0");
      var yyyy = today.getFullYear();
      today = yyyy + "-" + mm + "-" + dd;
      return today;
    },
    async getAvailableTimes() {
      console.log(this.RDVDate);
      let obj = {
        c_date: this.RDVDate
      };
      const response = await axios.post(
        "http://localhost:4000/Controller/RDV/checkAvailableTimes",
        obj
      );
      if (response.data.status == true) {
        this.creneaux_obj = response.data.data;
        console.log(response.data.data);
        console.log(this.creneaux_obj);
      }
    },
    async BookARDV() {
      let obj = {
        patientId_fk: sessionStorage.getItem("patientId"),
        creneau_id_fk: this.creneau,
        patient_subject: this.subject,
        c_date: this.AppointementDate
      };
      console.log(obj);

      const response = await axios.post(
        "http://localhost:4000/Controller/RDV/createARDV",
        obj
      );

      if (response.data.status == true) {
        console.log(response.data.message);
        this.$router.push("/RendezV");
      }
    },
    checkPatient() {
      let patientId = sessionStorage.getItem("patientId");
      console.log(typeof patientId);
      if (patientId != null) {
        console.log("hey");
      } else {
        this.$router.push("/SignAccount");
      }
    }
  },
   async deleteARDV(id) {
      console.log(id);
      let obj = {
        rdv_id: id
      };
      console.log(obj);
      const response = await axios.delete(
        "http://localhost:4000/Controller/RDV/deleteARDV/${id}"
      );

      if (response.data) {
        console.log(response.data);
      }
      this.getAllRDVs();
    },

    checkPatientr() {
      let patientId = sessionStorage.getItem("patientId");
      if (patientId != null) {
        this.getAllRDVs();
      } else {
        this.$router.push("/SignAccount");
      }
    },
    async getAllRDVs() {
      let P_id = sessionStorage.getItem("patientId");
      let obj = "";
      const response = await axios.get(
        "http://localhost:4000/Controller/RDV/showMyRDVs/" +
          P_id,
        obj
      );

      if (response.data.status == true) {
        this.app = true;
        console.log(response.data);
        this.rdvs_obj = response.data.rdvs;
        this.user_personal_informations = response.data.personal_infos;
        console.log("obj is : ");
        console.log(this.rdvs_obj);
      } else {
        this.app = false;
      }
    },

  beforeMount() {
    this.checkPatient();
  }
};
</script>

<style scoped>
h1{
/* background-color:rgb(144, 200, 247); */
color:rgb(0, 0, 0);
padding:8px;
margin-top:0;
margin-bottom:50px;
}
.form_label {
  display: block;
  float: left;
}
/* .form-group-error{
    color: red;
}
.form-group-error input{
    border-color: red;
}
.form-group-error select{
    border-color: red;
} */


</style>