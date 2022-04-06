<template>
  <div class="container mt-5 mb-5 d-flex justify-content-center">
    <form @submit.prevent="BookARDV">
    <div class="card px-1 py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group my-4">
                      <label for="date">Enter Your date</label>
                     <input class="form-control" type="date" 
                     placeholder="Name" v-model="RDVDate" :min="TodayDate()" @change="getAvailableTimes"> 
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
              <label class="form_label" for="Reference">Choose time</label>
              <div class="input-group my-4">
              <select class="form-control" v-model="creneau">
              <option value="" selected hidden>choose a creneau</option>
              <option
                v-for="(time, index) in times_obj"
                :value="time.creneau_id"
                :key="index"
                >{{ time.start_at }} - {{ time.end_at }}
              </option>
            </select>
             </div>
            </div>
          </div>
        </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                      <label for="subject">Enter Your subject</label>
                     <input class="form-control" type="text" 
                     placeholder="subject" v-model="subject" /> 
                     </div>
                </div>
            </div>
            <div class=" d-flex flex-column text-center px-5 mt-3 mb-3"> <small class="agree-text">By Booking this appointment you agree to the</small> 
            <a href="#" class="terms">Terms & Conditions</a> 
            </div> 
            <button type="submit" class="btn btn-primary btn-block confirm-button">Book now</button>
        </div>
    </div>
    </form>
</div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      patientId: "",
      date: "",
      obj: "",
      times: "",
      times_obj:{},
      creneau: "",
      RDVDate: "",
      subject: "",
      selected: '',
      today: ""
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
        "http://localhost/dentaire/RDV/checkAvailableTimes",
        obj
      );
      if (response.data.status == true) {
        this.times_obj = response.data.data;
        console.log(response.data.data);
        console.log(this.times_obj);
      }
    },
    async BookARDV() {
      let obj = {
        patientId_fk: sessionStorage.getItem("patientId"),
        creneau_id_fk: this.creneau,
        patient_subject: this.subject,
        c_date: this.RDVDate
      };
      console.log(obj);
      const response = await axios.post(
        "http://localhost/dentaire/RDV/createARDV",
        obj
      );
      if (response.data.status == true) {
        console.log(response.data.message);
        this.$router.push("/ListRDV");
      }
    },
    checkPatient() {
      let patientId = sessionStorage.getItem("patientId");
      console.log(typeof patientId);
      if (patientId != null) {
        console.log("OKKKK");
      } else {
        this.$router.push("/sign");
      }
    }
  },
  beforeMount() {
    this.checkPatient();
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.container {
  display: flex;
  justify-content: center;
}
.form_container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border: 1px dashed #42b983;
  border-radius: 20px;
  padding: 20px 30px;
  width: 25%;
}
.form_label {
  display: block;
  float: left;
}
.form_input_container {
  display: block;
  margin: 10px;
  width: 100%;
}
.form_input {
  width: 100%;
  padding: 10px 5px;
  margin: 5px auto;
  border: 0 none #ccc;
  border-bottom: 2px solid #42b983;
}
.form_input:focus {
  border: 2px solid #42b983;
  outline: none;
}
.form_button {
  display: block;
  padding: 10px 20px;
  background-color: #42b983;
  border: none;
  border-radius: 20px;
  outline: none;
}
</style>