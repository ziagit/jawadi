<template>
  <div class="container">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="content">
      <div class="md-display-1">Book a service in just a few steps</div>
      <div class="md-subheading">We give value to our customers!</div>
      <div class="break"></div>
      <div class="break"></div>
      <div class="md-title">What service do you need?</div>
      <div class="break"></div>
      <div class="break"></div>
      <div class="actions">
        <md-button class="md-primary md-raised custom-button" to="/order/location"
          >Book now</md-button
        >
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";

export default {
  name: "HomeContent",
  props: ["scrollValue"],
  data: () => ({}),

  methods: {
    menuTogal() {
      this.$emit("menu-togal");
    },
    getQoute() {
      this.$router.push("/order/location");
    },
  },

  components: {
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  .content {
    text-align: center;
    height: calc(100vh);
    text-align: center;
    max-width: 600px;
    margin: auto;
    padding-top: 163px;
    .md-subheading {
      color: #448aff;
    }
    .actions {
      .md-button {
        margin-right: 16px;
      }
    }
  }

  @media only screen and (max-width: 600px) {
    .content {
      padding: 112px 10px !important;
      text-align: center !important;
      .md-display-1 {
        font-size: 42px !important;
        line-height: 48px !important;
      }
      .md-subheading {
        font-size: 14px !important;
      }
      .md-title {
        font-size: 17px !important;
      }
    }

    .md-body-1 {
      max-width: 100% !important;
    }
  }
}
</style>
