<template>
  <div class="container">
    <div class="md-display-1">Your job is submitted!</div>
    <div>Do you need anything else done?</div>
    <div class="break"></div>

    <div class="row">
      <div class="col" v-for="category in categories" :key="category.id">
        <md-card
          v-if="category.categories != ''"
          v-model="selected"
          :value="category.categories"
        >
          <md-card-content>
            {{ category.categories }}
          </md-card-content>
        </md-card>
      </div>
    </div>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import Snackbar from "../../shared/Snackbar";
import localData from "../services/localData";
export default {
  name: "Origin",
  data: () => ({
    selected: "bs",
    supportedArea: null,
    initialData: null,
    categories: null,

    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),

  methods: {
    async nextStep() {
      await localData.save("categories", this.selected);
      this.$router.push("/order/posted");
    },

    async init() {
      this.selected = await localData.read("job-categories");
    },
    getcategories() {
      axios
        .get("categories")
        .then((res) => {
          this.categories = res.data;
          console.log("xxxxxxxxx", this.categories);
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
  created() {
    this.$emit("progress", 9);
    this.init();
    this.getcategories();
    localData.save("cRoute", this.$router.currentRoute.path);
  },
  components: {
    Snackbar,
  },
};
</script>

<style lang="scss" scoped>
.container {
  text-align: center;
  .row {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    .col {
      flex: 50%;
      .md-card {
        margin: 10px;
      }
    }
  }
}

@media only screen and (max-width: 600px) {
}
</style>
