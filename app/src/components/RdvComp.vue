<template>
<div>   
     <h1 class="text-center">Gestion des rendez-vous d'un cabinet dentaire</h1>
</div>
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
    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="errMsg">
        {{errMsg}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">
        </button>
    </div>

    <!-- show success message -->
    
     <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="successMsg">
        {{successMsg}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">
        </button>
    </div>

    <!-- show rdv details : table -->
    <table class="table table-border table-striped caption-top">
        <caption>
            List of Rdv ({{ RdvData.length }}) 
        </caption>
        <thead>
            <tr class="bg-dark text-light text-center">
                <th><FIcon :icon="['far','id-card']" />  Id rdv</th>
                <th><FIcon :icon="['fas','tasks']" />  Sujet</th>
                <th><FIcon :icon="['far','calendar']" />  Date Creneau</th>
                <th><FIcon :icon="['far','address-card']" />  Reference</th>
                <th><FIcon :icon="['fas','cog']" />  Actions</th>
            </tr>
            </thead>
                <tbody>

                    <tr class="text-center">
                        <td>1</td>
                        <td>sujet1</td>
                        <td>01/07/2022</td>
                        <td>AZERTYUI</td>
                        <td>
                            <button type="button" class="btn text-danger " data-bs-toggle="modal" data-bs-target="#Exampless"> <FIcon :icon="['fas','user-times']" /> </button> <br>
                            <button type="button" class="btn text-success " data-bs-toggle="modal" data-bs-target="#examples">
                                 <FIcon :icon="['fas','user-edit']" /> </button>
                        </td>

                    </tr>

                      <tr class="text-center">
                        <td>1</td>
                        <td>sujet1</td>
                        <td>01/07/2022</td>
                        <td>AZERTYUI</td>
                        <td>
                            <button type="button" class="btn text-danger " data-bs-toggle="modal" data-bs-target="#Exampless"> <FIcon :icon="['fas','user-times']" /> </button> <br>
                            <button type="button" class="btn text-success " data-bs-toggle="modal" data-bs-target="#examples">
                                 <FIcon :icon="['fas','user-edit']" /> </button>
                        </td>

                    </tr>
                </tbody>
        
    </table>
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
            <form action="#" method="post" @click.prevent>
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.newRdv.sujetR.$error}"> -->
          <input type="text" name="sujet" id="sujetfloat" class="form-control" placeholder="Sujet de rdv" v-model.trim="newRdv.sujetR">
          <!-- <span class="error-feedback" v-if="v$.newRdv.sujetR.$error">
        {{v$.newRdv.sujetR.$errors[0].$message}}
         </span> -->
          <!-- </div> -->
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.newRdv.dateC.$error}"> -->
          <input type="date" name="dateC" id="datefloat" class="form-control my-3" v-model.trim="newRdv.dateC">
           <!-- <span class="error-feedback" v-if="v$.newRdv.dateC.$error">
        {{v$.newRdv.dateC.$errors[0].$message}}
         </span> -->
        <!-- </div> -->
         <!-- <div class="form-floating" :class="{'form-group-error' : v$.newRdv.time.$error}"> -->
        <select class="form-select" aria-label="Default select example" v-model.trim="newRdv.time">
        <option selected>Select time</option>
        <option >09 | 10</option>
        <option >10 | 11</option>
        <option >11 | 12</option>
        <option >12 | 13</option>
        <option >13 | 14</option>
        <option >14 | 15</option>
        </select>     
         <!-- <span class="error-feedback" v-if="v$.newRdv.time.$error">
        {{v$.newRdv.time.$errors[0].$message}}
         </span> -->
         <!-- </div> -->
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="addNewRdv()">Add rdv</button>
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
            <form action="#" method="post" @click.prevent>
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.currentRdv.sujetR.$error}"> -->
          <input type="text" name="sujet" id="sujetfloat" class="form-control" placeholder="Sujet de rdv" v-model.trim="currentRdv.sujetR">
          <!-- <span class="error-feedback" v-if="v$.currentRdv.sujetR.$error">
        {{v$.currentRdv.sujetR.$errors[0].$message}}
         </span> -->
          <!-- </div> -->
        <!-- <div class="form-floating" :class="{ 'form-group-error': v$.currentRdv.dateC.$error}"> -->
          <input type="date" name="dateC" id="datefloat" class="form-control my-3" v-model.trim="currentRdv.dateC">
           <!-- <span class="error-feedback" v-if="v$.currentRdv.dateC.$error">
        {{v$.currentRdv.dateC.$errors[0].$message}}
         </span> -->
        <!-- </div> -->
         <!-- <div class="form-floating" :class="{'form-group-error' : v$.currentRdv.time.$error}"> -->
        <select class="form-select" aria-label="Default select example" v-model.trim="newRdv.time">
        <option selected>Select time</option>
        <option >09 | 10</option>
        <option >10 | 11</option>
        <option >11 | 12</option>
        <option >12 | 13</option>
        <option >13 | 14</option>
        <option >14 | 15</option>
        </select>     
         <!-- <span class="error-feedback" v-if="v$.currentRdv.time.$error">
        {{v$.currentRdv.time.$errors[0].$message}}
         </span> -->
         <!-- </div> --> 
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updateRdv()">Update rdv</button>
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
                <p>
                    <span>
                     <FIcon :icon="['fas','tasks']" />&nbsp; Sujet1 <br>
                    </span>

                    <span>
                     <FIcon :icon="['far','calendar']" />&nbsp; 01-04-2022 <br>
                    </span>

                    <span>
                     <FIcon :icon="['far','calendar']" />&nbsp; 10:00 | 11:00 <br>
                    </span>
                </p>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="deleteRdv()">Delete rdv</button>
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
                <p>
                    <span>
                     <FIcon :icon="['fas','tasks']" />&nbsp; Sujet1 <br>
                    </span>

                    <span>
                     <FIcon :icon="['far','calendar']" />&nbsp; 01-04-2022 <br>
                    </span>

                    <span>
                     <FIcon :icon="['far','calendar']" />&nbsp; 10:00 | 11:00 <br>
                    </span>
                </p>
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
</template>

<script>
import useValidate from "@vuelidate/core";
import {required, minLength} from "@vuelidate/validators";
export default {
    name: 'RdvComp',
    data(){
        return{
            v$: useValidate(),
            errMsg:'',
            successMsg:'',
            RdvData: [],
            newRdv:{
                sujetR: '',
                dateC: '',
                time: ''
            },
            currentRdv: {},
        };
    },
    validattions(){
        return{
           newRdv: {
               sujetR: {required, minLength: minLength(10)},
               dateC:  {required},
               time: {required},

           },
        };
    },
    methods: {
        addNewRdv(){
            this.v$.newRdv.$validate();
            if(!this.v$.newRdv.$error){
                console.log("Add rdv : successfuly");
            }
            else {
                console.log("Add rdv : not validated");
            }
        },
        updateRdv(){
            this.v$.currentRdv.$validate();
            if(!this.v$.currentRdv.$error){
                console.log("Update rdv : successfuly");
            }
            else {
                console.log("Update rdv : not validated");
            }
        },
         deleteRdv(){
            this.v$.currentRdv.$validate();
            if(!this.v$.currentRdv.$error){
                console.log("Delete rdv : successfuly");
            }
            else {
                console.log("Delete rdv : not validated");
            }
        },
        deleteAllRdv(){
            this.v$.currentRdv.$validate();
            if(!this.v$.currentRdv.$error){
                console.log("Delete all rdv : successfuly");
            }
            else {
                console.log("Delete all rdv : not validated");
            }
        }
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

.form-group-error{
    color: red;
}
.form-group-error input{
    border-color: red;
}
.form-group-error select{
    border-color: red;
}


</style>