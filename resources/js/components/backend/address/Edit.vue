<template>
  <div>
    <form @submit.prevent="update" enctype="multipart/form-data">
      <div class="carrier-details">
        <div class="row">
          <md-field>
            <label for="">Select country</label>
            <md-select v-model="form.country" name="country" id="country">
              <md-option
                v-for="country in countries"
                :value="country.id"
                :key="country.id"
                >{{ country.name }}</md-option
              >
            </md-select>
            <input class="hidden-input" v-model="form.country" required />
          </md-field>
          <md-menu md-direction="bottom-start" class="" md-align-trigger md-dense>
            <md-field>
              <label for="">Search state</label>
              <md-input
                v-model="sk"
                required
                md-menu-trigger
                @change="onStateChange"
              ></md-input>
            </md-field>
            <md-menu-content>
              <div v-if="states">
                <md-menu-item v-if="states.length === 0">Not found</md-menu-item>
              </div>
              <div v-else>
                <md-menu-item>Type</md-menu-item>
              </div>
              <md-menu-item
                v-for="list in states"
                :key="list.id"
                @click="selectState(list)"
                >{{ list.name }}</md-menu-item
              >
            </md-menu-content>
          </md-menu>
          <md-menu md-direction="bottom-start" class="" md-align-trigger md-dense>
            <md-field>
              <label for="">Search city</label>
              <md-input
                v-model="ck"
                required
                md-menu-trigger
                @change="onCityChange"
              ></md-input>
            </md-field>
            <md-menu-content>
              <div v-if="cities">
                <md-menu-item v-if="cities.length === 0">Not found</md-menu-item>
              </div>
              <div v-else>
                <md-menu-item>Type</md-menu-item>
              </div>
              <md-menu-item
                v-for="list in cities"
                :key="list.id"
                @click="selectCity(list)"
                >{{ list.name }}</md-menu-item
              >
            </md-menu-content>
          </md-menu>
        </div>
        <div class="row">
          <md-menu
            md-direction="bottom-start"
            class="zip-address"
            md-align-trigger
            md-dense
          >
            <md-field>
              <label for="">Search address</label>
              <md-input
                v-model="ak"
                required
                md-menu-trigger
                @change="onAddressChange"
              ></md-input>
            </md-field>
            <md-menu-content>
              <div v-if="addresses">
                <md-menu-item v-if="addresses.length === 0">Not found</md-menu-item>
              </div>
              <div v-else>
                <md-menu-item>Type</md-menu-item>
              </div>
              <md-menu-item
                v-for="list in addresses"
                :key="list.id"
                @click="selectAddress(list)"
                >{{ list.name }}</md-menu-item
              >
            </md-menu-content>
          </md-menu>
          <md-menu
            md-direction="bottom-start"
            class="zip-address"
            md-align-trigger
            md-dense
          >
            <md-field>
              <label for="">Search postal code</label>
              <md-input v-model="zk" required md-menu-trigger></md-input>
            </md-field>
            <md-menu-content>
              <div v-if="zips">
                <md-menu-item v-if="zips.length === 0">Not found</md-menu-item>
              </div>
              <div v-else>
                <md-menu-item>Type</md-menu-item>
              </div>
              <md-menu-item
                v-for="list in zips"
                :key="list.id"
                @click="selectZip(list)"
                >{{ list.postal_code }}</md-menu-item
              >
            </md-menu-content>
          </md-menu>
        </div>
      </div>

      <md-button type="submit" class="md-primary md-small-fab">Done</md-button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "Edit",
  props: ["address"],
  data: () => ({
    form: {
      country: null,
      state: null,
      city: null,
      address: null,
      postal_code: null,
    },
    countries: null,
    states: null,
    cities: null,
    addresses: null,
    zips: null,
    sk: null,
    ck: null,
    ak: null,
    zk: null,
  }),
  watch: {
    sk(after, before) {
      this.getState();
    },
    ck(after, before) {
      this.getCity();
    },
    zk(after, before) {
      this.getZip();
    },
    ak(after, before) {
      this.getAddress();
    },
  },
  methods: {
    getState() {
      axios
        .get("search-state/" + this.form.country, {
          params: {
            keywords: this.sk,
          },
        })
        .then((res) => {
          console.log("states: ", res.data.data);
          this.states = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCity() {
      axios
        .get("search-city/" + this.form.state, {
          params: {
            keywords: this.ck,
          },
        })
        .then((res) => {
          console.log("cities: ", res.data.data);
          this.cities = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getAddress() {
      axios
        .get("search-address/" + this.form.city, {
          params: {
            keywords: this.ak,
          },
        })
        .then((res) => {
          console.log("address: ", res.data.data);
          this.addresses = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getZip() {
      axios
        .get("search-zip/" + this.form.address, {
          params: {
            keywords: this.zk,
          },
        })
        .then((res) => {
          console.log("zips: ", res.data.data);
          this.zips = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    selectState(selected) {
      this.sk = selected.name;
      this.form.state = selected.id;
    },

    selectCity(selected) {
      this.ck = selected.name;
      this.form.city = selected.id;
    },

    selectAddress(selected) {
      this.ak = selected.name;
      this.form.address = selected.id;
    },
    selectZip(selected) {
      this.zk = selected.postal_code;
      this.form.postal_code = selected.id;
    },
    onStateChange() {
      this.ck = null;
      this.zk = null;
      this.ak = null;
      this.form.city = null;
      this.form.postal_code = null;
      this.form.address = null;
      this.cities = null;
      this.zips = null;
      this.addresses = null;
    },
    onCityChange() {
      this.zk = null;
      this.ak = null;
      this.form.postal_code = null;
      this.form.address = null;
      this.zips = null;
      this.addresses = null;
    },
    onAddressChange() {
      this.zk = null;
      this.form.postal_code = null;
      this.zips = null;
    },

    update() {
      axios
        .put("admin/customer/addresses/" + this.address.id, this.form)
        .then((res) => {
          console.log("response ", res.data);
          /*  this.$emit('close-dialog') */
        })
        .catch((error) => {
          console.log("eerrr: ", error);
        });
    },
    init() {
      console.log(this.address);
      this.form.country = this.address.country.id;
      this.form.state = this.address.state.id;
      this.form.city = this.address.city.id;
      this.form.address = this.address.address.id;
      this.form.postal_code = this.address.zip.id;
      this.sk = this.address.state.name;
      this.ck = this.address.city.name;
      this.zk = this.address.zip.postal_code;
      this.ak = this.address.address.name;
    },
    getCountries() {
      axios
        .get("countries")
        .then((res) => {
          this.countries = res.data;
          this.init();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    tapHandler(direction) {
      console.log("tap: ", direction);
    },
  },
  created() {
    this.getCountries();
  },
};
</script>

<style lang="scss" scoped>
.row {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;

  .md-field {
    flex: 25%;
  }
}

.add-btn {
  position: absolute;
  top: 0;
  right: 0;
}

.zip-address {
  flex: 50%;
}

.md-menu-content-bottom-start,
.md-menu-content-small,
.md-menu-content {
  z-index: 100;
  /*     position: absolute;
    top: 364px !important; */
}
</style>
