<template>
  <div>
    <MDBTable style="width: 70%" class="align-middle mb-0 bg-white" id="tabel">
      <thead class="bg-light">
        <tr>
          <th>Nume</th>
          <th>Pret</th>
          <th>Descriere</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="produs in produse" :key="produs.id">
          <td>
            <div class="d-flex align-items-center">
              <img
                src="https://www.felicitaripersonalizate.com/images/personalizate-imagini/poza/poza2027.png"
                alt=""
                style="width: 45px; height: 45px"
                class="rounded-circle"
              />&nbsp;
              <div class="ms-3">
                <p class="fw-bold mb-1">{{ produs.nume }}</p>
              </div>
            </div>
          </td>
          <td>
            <p class="fw-normal mb-1">{{ produs.pret }}</p>
          </td>
          <td style="max-width: 100px; overflow: hidden">
            <MDBBadge badge="success" pill class="d-inline">{{
              produs.descriere
            }}</MDBBadge>
          </td>
          <td>
            <button
              type="button"
              class="buton"
              @click="stergeProdus(produs.id)"
            >
              Sterge</button
            >&nbsp;&nbsp;
            <button
              type="button"
              class="buton"
              @click="editeazaProdus(produs.id)"
            >
              editeaza
            </button>
          </td>
        </tr>
      </tbody>
    </MDBTable>
  </div>
</template>

<script>
import { MDBTable, MDBBtn, MDBBadge } from "mdb-vue-ui-kit";

export default {
  data() {
    return {
      produse: [],
    };
  },
  components: {
    MDBTable,
    MDBBtn,
    MDBBadge,
  },
  methods: {
    async stergeProdus(id) {
      let res = await this.axios.post(
        "http://localhost/db-login/public/Produse/stergeProdus",
        {
          id: id,
        }
      );
      this.getInfo();
    },
    async getInfo() {
      let res = await this.axios.get(
        "http://localhost/db-login/public/Produse/getProduse"
      );
      this.produse = res.data;
    },
    async editeazaProdus(id) {},
  },
  async mounted() {
    if (!localStorage.getItem("emailUtilizator")) {
      this.$router.push("/");
    } else {
      this.getInfo();
    }
  },
};
</script>

<style>
#tabel {
  margin: auto;
  margin-top: 100px;
}
.buton {
  border-radius: 15px;
  background-color: rgb(82, 82, 94);
}
</style>
