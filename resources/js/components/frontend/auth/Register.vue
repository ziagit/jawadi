<template>
  <div class="container">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="content">
      <md-card>
        <md-card-header>
          <div class="md-title">Register</div>
        </md-card-header>
        <md-card-content>
          <Spinner v-if="loading" />
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <md-field>
              <label>Name</label>
              <md-input v-model="form.name" required ref="focusable"></md-input>
            </md-field>
            <md-field>
              <label>Email</label>
              <md-input v-model="form.email" required></md-input>
            </md-field>
            <md-field>
              <label>Password</label>
              <md-input v-model="form.password" required></md-input>
            </md-field>
            <md-field>
              <label>Confirm password</label>
              <md-input v-model="form.password_confirmation" required></md-input>
            </md-field>
            <div>
              <md-radio v-model="form.type" value="carrier">Carrier</md-radio>
              <md-radio v-model="form.type" value="shipper">Shipper</md-radio>
            </div>
            <md-button type="submit" class="md-primary">Register</md-button>
          </form>
          <router-link to="/login">Already have account</router-link>
        </md-card-content>
      </md-card>
    </div>
    <Footer />
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import axios from "axios";
import { mapActions } from "vuex";
import Spinner from "../../shared/Spinner";
import Snackbar from "../../shared/Snackbar";
import Header from "../../shared/Header";
import Footer from "../../shared/Footer";
export default {
  name: "SignUp",
  data: () => ({
    form: {
      name: null,
      email: null,
      password: null,
      password_confirmation: null,
      type: "shipper",
    },
    loading: false,
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),
  methods: {
    ...mapActions({
      signUp: "auth/signUp",
    }),
    submit() {
      if (this.form.password !== this.form.password_confirmation) {
        this.snackbar.show = true;
        this.snackbar.statusCode = 400;
        this.snackbar.message = "Passwords not matching!";
      } else {
        this.loading = true;
        this.signUp(this.form)
          .then((res) => {
            this.loading = false;
            this.$router.push("welcome");
          })
          .catch((error) => {
            if (error.response.status === 409) {
              this.snackbar.statusCode = error.response.status;
              this.snackbar.message = error.response.data.error;
            } else {
              this.snackbar.statusCode = error.response.status;
              this.snackbar.message = error.response.data.error;
            }
            this.snackbar.show = true;
          });
      }
    },
  },
  mounted() {
    this.$refs.focusable.$el.focus();
  },
  components: {
    Spinner,
    Snackbar,
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  width: 100%;
  .content {
    padding: 60px 20px;
    height: calc(100vh - 3px);

    .md-card {
      max-width: 500px;
      margin: auto;
      text-align: center;
      background: #fff;

      .md-card-content {
        padding: 20px;
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .register {
    .md-card {
      margin-top: 3em;

      .other-way {
        .md-button {
          font-size: 11px;
        }
      }
    }
  }
}
</style>
