<template>
  <div class="login">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
          v-model="email"
        />
        <small id="emailHelp" class="form-text text-muted"
          >We'll never share your email with anyone else.</small
        >
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          type="password"
          class="form-control"
          id="exampleInputPassword1"
          placeholder="Password"
          v-model="password"
        />
      </div>

      <button @click="click" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      checked: true,
    };
  },
  methods: {
    async click() {
      let res = await this.axios.post(
        "http://localhost/db-login/public/Login/login",
        {
          email: this.email,
          password: this.password,
        }
      );

      console.log({ raspuns: res });

      if (res.data.ok) {
        localStorage.setItem("idUtilizator", res.data.idUser);
        localStorage.setItem("token", res.data.token);
        this.$router.push("/produse");
      }
    },
  },
};
</script>

<style scoped>
.login {
  width: 50%;
  margin: auto;
}
</style>
