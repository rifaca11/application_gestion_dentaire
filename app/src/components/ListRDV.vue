<template>
  <div class="table-wrapper my-5">
    <table class="fl-table" v-if="app">
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
        <tr
          v-for="(rdv, index) in rdvs_obj"
          :key="rdv.rdv_id"
        >
          <td>{{ index + 1 }}</td>
          <td>{{ rdv.patient_subject }}</td>
          <td>{{ rdv.c_date }}</td>
          <td>{{ rdv.start_at }} - {{ rdv.end_at }}</td>
          <td>{{ rdv.rdv_id }}</td>
          <td>
            <button class="btn" @click="updateARDV(rdv.rdv_id)">Update</button>
            <button
              class="btn btn2"
              @click="deleteARDV(rdv.rdv_id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <p v-else>There are no rdvs</p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: 'ListRDV',
  data() {
    return {
      rdvs_obj: {},
      patient_personal_informations: {},
      app: false
    };
  },
  methods: {
    async deleteARDV(id) {
      console.log(id);
      let obj = {
        rdv_id: id
      };
      console.log(obj);
      const response = await axios.get(
        "http://localhost/dentaire/RDV/deleteARDV/" +obj.rdv_id
       
      );
    
      if (response.data) {
        console.log(response.data);
      }
      this.getAllRDVs();
    },
    async updateARDV() {
      let obj = {
        creneau_id_fk: this.creneau,
        patient_subject: this.subject,
        c_date: this.RDVDate
      };
      console.log(obj);
      const response = await axios.post(
        "http://localhost/dentaire/RDV/updateARDV",
        obj
      );
      if (response.data.status == true) {
        console.log(response.data.message);
        this.$router.push("/ListRDV");
      }
    },
    checkPatient() {
      let patientId = sessionStorage.getItem("patientId");
      if (patientId != null) {
        this.getAllRDVs();
      } else {
        this.$router.push("/sign");
      }
    },
    async getAllRDVs() {
      let P_id = sessionStorage.getItem("patientId");
      const response = await axios.get(
        "http://localhost/dentaire/RDV/showMyRDV/" +
          P_id);
      if (response.data.status == true) {
        this.app = true;
        console.log(response.data);
        this.rdvs_obj = response.data.rdv;
        this.patient_personal_informations = response.data.personal_infos;
        console.log("obj is : ");
        console.log(this.rdvs_obj);
      } else {
        this.app = false;
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
/* Table Styles */
.table-wrapper {
  margin: 10px 70px 70px;
  box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
}
.fl-table {
  border-radius: 5px;
  font-size: 12px;
  font-weight: normal;
  border: none;
  border-collapse: collapse;
  width: 100%;
  max-width: 100%;
  white-space: nowrap;
  background-color: white;
}
.fl-table td,
.fl-table th {
  text-align: center;
  padding: 20px;
}
.fl-table td {
  border-right: 1px solid #f8f8f8;
  font-size: 12px;
}
.fl-table thead th {
  color: #ffffff;
  background:#0d6efd;
}
.fl-table thead th:nth-child(odd) {
  color: #ffffff;
  background: #324960;
}
.fl-table tr:nth-child(even) {
  background: #f8f8f8;
}
.btn {
  width: 80px;
  height: 25px;
  background-color: #0d6efd;
  border: none;
  margin: 0px 10px;
  color: #ffffff;
  cursor: pointer;
}
.btn2 {
  background-color: #f25c78;
}
/* Responsive */
@media (max-width: 767px) {
  .fl-table {
    display: block;
    width: 100%;
  }
  .table-wrapper:before {
    content: "Scroll horizontally >";
    display: block;
    text-align: right;
    font-size: 11px;
    color: white;
    padding: 0 0 10px;
  }
  .fl-table thead,
  .fl-table tbody,
  .fl-table thead th {
    display: block;
  }
  .fl-table thead th:last-child {
    border-bottom: none;
  }
  .fl-table thead {
    float: left;
  }
  .fl-table tbody {
    width: auto;
    position: relative;
    overflow-x: auto;
  }
  .fl-table td,
  .fl-table th {
    padding: 20px 0.625em 0.625em 0.625em;
    height: 60px;
    vertical-align: middle;
    box-sizing: border-box;
    overflow-x: hidden;
    overflow-y: auto;
    width: 120px;
    font-size: 13px;
    text-overflow: ellipsis;
  }
  .fl-table thead th {
    text-align: left;
    border-bottom: 1px solid #f7f7f9;
  }
  .fl-table tbody tr {
    display: table-cell;
  }
  .fl-table tbody tr:nth-child(odd) {
    background: none;
  }
  .fl-table tr:nth-child(even) {
    background: transparent;
  }
  .fl-table tr td:nth-child(odd) {
    background: #f8f8f8;
    border-right: 1px solid #e6e4e4;
  }
  .fl-table tr td:nth-child(even) {
    border-right: 1px solid #e6e4e4;
  }
  .fl-table tbody td {
    display: block;
    text-align: center;
  }
}
</style>