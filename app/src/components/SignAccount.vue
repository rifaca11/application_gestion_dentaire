<template>
  <div>
<form @submit.prevent="signup" v-if="display">
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="../assets/dent.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                  
                    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center">Dental Register</small>
                        <div class="line"></div>
                    </div>
                    <div class="row px-3"> <label class="mb-1" for="patientFirstName">
                            <h6 class="mb-0 text-sm">First Name</h6>
                        </label> <input class="mb-4" type="text" placeholder="Enter a valid email address" v-model="patientFirstName"> </div>
                      <div class="row px-3"> <label class="mb-1" for="patientLastName">
                            <h6 class="mb-0 text-sm">Last Name</h6>
                        </label> <input class="mb-4" type="text" placeholder="Enter a last name" v-model="patientLastName"> </div>
                        <div class="row px-3"> <label class="mb-1" for="patientCIN">
                            <h6 class="mb-0 text-sm">CIN</h6>
                        </label> <input class="mb-4" type="text" placeholder="Enter cin" v-model="patientCIN" > </div>
                        <div class="row px-3"> <label class="mb-1" for="patientEmail">
                            <h6 class="mb-0 text-sm">Email</h6>
                        </label> <input type="email" placeholder="Enter email" v-model="patientEmail"> </div>
           
                    <div class="row mb-3 px-3 py-3"> <button type="submit" class="btn btn-primary text-center">Sign Up</button> </div>
                    <div class="row mb-4 px-3"> <small v-if="incomplete">{{ msg }}</small>
      <span>Already got an account.
        <span class="swap" @click="showSign">
          Sign In
        </span>
        </span>
       </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


    <form @submit.prevent="signin" v-else>
      <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="../assets/dent.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                  
                    <div class="row px-3 mb-4">
                        <div class="line"></div> 
                        <small class="or text-center">Dental Login</small>
                        <div class="line"></div>
                    </div>
                    <div class="row px-3">
                       <label class="mb-1" for="Reference">
                            <h6 class="mb-0 text-sm">Enter Your Reference</h6>
                        </label>
                         <input class="mb-4" type="text" placeholder="Enter your reference" v-model="Reference">
                    </div>
                    <div class="row mb-3 px-3 py-3"> <button type="submit" class="btn btn-primary text-center">Sign in</button>
                    </div>
                </div>
          
      <small v-if="incomplete">{{ msg }}</small>
      <span>Register now from
        <span class="swap" @click="showSign">
          here
        </span>
      </span>
                </div>
            </div>
        </div>
      </div>
      
    </form>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Sign_Account',
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

        this.$router.push("/RendezVous");
      } else {
        this.incomplete = true;
        this.msg = "check your reference again";
        console.log(this.Reference);
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
body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #B0BEC5;
    background-repeat: no-repeat
}

.card0 {
    box-shadow: 0px 4px 8px 0px #757575;
    border-radius: 0px
}

.card2 {
    margin: 0px 40px
}

.logo {
    width: 80px;
    height: 50px;
    margin-top: 20px;
    margin-left: 35px
}

.image {
    width: 100%;
    height: 100%;
}

.border-line {
    border-right: 1px solid #EEEEEE
}

.line {
    height: 1px;
    width: 45%;
    background-color: #E0E0E0;
    margin-top: 10px
}

.or {
    font-weight: bold;
}

.text-sm {
    font-size: 14px !important
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px
}

input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

a {
    color: inherit;
    cursor: pointer
}

.btn-blue {
    background-color: #1A237E;
    width: 150px;
    color: #fff;
    border-radius: 2px
}

.btn-blue:hover {
    background-color: #000;
    cursor: pointer
}

.bg-blue {
    color: #fff;
    background-color: #1A237E
}
.swap{
  color: #0d6efd;
  font-weight: bold;
}
@media screen and (max-width: 991px) {
    .logo {
        margin-left: 0px
    }

    .image {
        width: 300px;
        height: 220px
    }

    .border-line {
        border-right: none
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px
    }
}
</style>
