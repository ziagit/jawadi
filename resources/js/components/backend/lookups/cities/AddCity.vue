<template>
  <div>
    <md-switch v-model="uploadTogal" @change="isUpload($event)">Upload file</md-switch>
    <form @submit.prevent="upload()" v-if="uploadTogal">
      <md-card>
        <md-card-content>
          <md-field>
            <label>Select file</label>
            <md-file v-on:change="onFileSelect($event)" />
          </md-field>
        </md-card-content>
        <md-card-actions>
          <md-button v-if="!uploading" type="submit" class="md-icon-button md-raised">
            <md-icon>cloud_upload</md-icon>
          </md-button>
          <Spinner v-if="uploading" />
        </md-card-actions>
      </md-card>
    </form>
    <form @submit.prevent="save()" v-else>
      <md-card>
        <md-card-content>
          <md-field>
            <label>Name</label>
            <md-input v-model="form.name" name="name"></md-input>
          </md-field>
          <md-field>
            <md-select v-model="form.state" id="state" placeholder="State">
              <md-option v-for="state in states" :key="state.id" :value="state.id">{{
                state.name
              }}</md-option>
            </md-select>
          </md-field>
        </md-card-content>
        <md-card-actions>
          <md-button type="submit" class="md-icon-button md-raised">
            <md-icon>save</md-icon>
          </md-button>
        </md-card-actions>
      </md-card>
    </form>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import Snackbar from "../../../shared/Snackbar";
import Spinner from "../../../shared/Spinner";
import Vue from "vue";
import axios from "axios";

export default {
  data: () => {
    return {
      form: {
        name: null,
        state: null,
      },
      states: null,
      file: null,
      uploadTogal: false,
      uploading: false,
      snackbar: {
        show: false,
        message: null,
        statusCode: null,
      },
    };
  },
  methods: {
    isUpload(e) {
      this.uploadTogal = e;
    },
    onFileSelect(e) {
      this.file = e.target.files[0];
      console.log(this.file);
    },
    upload() {
      this.uploading = true;
      let fd = new FormData();
      fd.append("file", this.file);
      axios
        .post("admin/upload-cities", fd)
        .then((res) => {
          console.log("imported: ", res.data, res.status);
          this.snackbar.show = true;
          this.snackbar.message = res.data.message;
          this.snackbar.statusCode = res.status;
          this.uploading = false;
          this.$emit("close-dialog");
        })
        .catch((err) => {
          this.uploading = false;
          this.snackbar.show = true;
          this.snackbar.message = err.response.data.message;
          this.snackbar.statusCode = err.response.status;
          console.log(err.response.data.message);
        });
    },
    save() {
      axios
        .post("admin/cities", this.form)
        .then((res) => {
          console.log("saved successfully! ", res.data);
          this.$emit("close-dialog");
        })
        .catch((err) => {
          this.snackbar.show = true;
          this.snackbar.message = err.response.data.message;
          this.snackbar.statusCode = err.response.status;
          console.log("Error: ", err.response);
        });
    },
    get() {
      axios
        .get("admin/states")
        .then((res) => {
          console.log("states lists", res.data.data);
          this.states = res.data.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
  created() {
    this.get();
  },
  components: {
    Spinner,
    Snackbar,
  },
};
</script>

<style scoped>
.md-card {
  box-shadow: none;
}
</style>
