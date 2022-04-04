<template>
  <div class="container">
    <form class="form_container" @submit.prevent="signup" v-if="display">
      <div class="form_input_container">
        <label class="form_label" for="userFirstName">First Name</label>
        <input class="form_input" type="text" v-model="patientFirstName" />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="patientLastName">Last Name</label>
        <input class="form_input" type="text" v-model="patientLastName" />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="patientCIN">CIN</label>
        <input class="form_input" type="text" v-model="patientCIN" />
      </div>
      <div class="form_input_container">
        <label class="form_label" for="patientEmail">Email</label>
        <input class="form_input" type="text" v-model="patientEmail" />
      </div>
      <button type="submit" class="form_button">
        Sign Up
      </button>
      <small v-if="incomplete">{{ msg }}</small>
      <span
        >Already got an account.
        <span class="swap" @click="showSign">
          Sign In.
        </span></span
      >
    </form>

    <form class="form_container" @submit.prevent="signin" v-else>
      <div class="form_input_container">
        <label class="form_label" for="Reference">Enter Your Reference</label>
        <input class="form_input" type="text" v-model="Reference" />
      </div>
      <button type="submit" class="form_button">
        check
      </button>
      <small v-if="incomplete">{{ msg }}</small>
      <span
        >Register now from
        <span class="swap" @click="showSign">
          here
        </span></span
      >
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      Reference: "",
      patientFirstName: "",
      patientLastName: "",
      patientCIN: "",
      patientEmail: "",
      display: true,
      incomplete: false,
      msg: ""
    };
  },
  methods: {
    async signup() {
      console.log(5555);
      let obj = {
        patientFirstName: this.patientFirstName,
        patientLastName: this.patientLastName,
        patientCIN: this.patientCIN,
        patientEmail: this.patientEmail
      };
      const res = await axios.post(
        "http://localhost/dentaire/Patients/create",
        obj
      );

      if (res.data.state) {
        this.showSign();
        // get the generate token and put it data components ( Reference )
        this.Reference = res.data.reference;
      } else {
        this.incomplete = true;
        this.msg = res.data.message;
      }
    },
    async signin() {
      let obj = {
        Reference: this.Reference
      };

      const res = await axios.post(
        "http://localhost/dentaire/Patients/checkPatient",
        obj
      );

      if (res.data.status == true) {
        console.log("your reference is correct");
        console.log(res.data);
        sessionStorage.setItem("patientId", res.data.patientInfo.patientId);
        sessionStorage.setItem(
          "patientFirstName",
          res.data.patientInfo.patientFirstName
        );
        localStorage.setItem("ifTrue", true);

        this.$router.push("/RendezV");
      } else {
        this.incomplete = true;
        this.msg = "check your reference again";
      }
    },
    showSign() {
      this.display = !this.display;
      this.incomplete = false;
      this.Reference = "";
      this.patientFirstName = "";
      this.patientLastName = "";
      this.patientCIN = "";
      this.patientEmail = "";
    }
  }
};
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
}
.form_container {
margin-top:20px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border: 1px dashed #0350f6;
  border-radius: 20px;
  padding: 20px 30px;
  width: 80%;
  height: auto;
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
  border-bottom: 2px solid #0350f6;
}
.form_input:focus {
  border: 2px solid #0350f6;
  outline: none;
}
.form_button {
  display: block;
  padding: 10px 20px;
  background-color: #0350f6;
  border: none;
  border-radius: 20px;
  margin-bottom: 10px;
}

.swap {
  cursor: pointer;
  text-decoration: underline;
}
</style>
