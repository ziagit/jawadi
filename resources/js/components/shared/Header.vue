<template>
  <div class="header">
    <div class="left">
      <md-button
        class="md-icon-button"
        @click="$emit('togal-menu')"
        :class="{ bgc: isScrolled }"
      >
        <md-icon>menu</md-icon>
      </md-button>
      <h3 @click="$router.push('/')"><span>a</span>Tradies</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: "Headder",
  props: ["scrollValue"],
  data: () => ({
    isScrolled: false,
  }),
  watch: {
    scrollValue(value) {
      if (value > 50) {
        this.isScrolled = true;
      } else {
        this.isScrolled = false;
      }
    },
  },
  methods: {},
  created() {},
};
</script>

<style lang="scss" scoped>
.bgc {
  transition: background-color 2s ease;
  background-color: #ddd9;
}
.header {
  margin: 0;
  display: flex;
  justify-content: space-between;
  /*  background: #000; */
  color: #fff;
  align-items: center;
  padding: 0 10px;
  width: 100%;
  top: 0;
  left: 0;

  .md-icon {
    color: #000;
  }

  .left {
    display: flex;
    align-items: center;

    .md-icon-button {
      position: fixed;
      z-index: 9;
    }

    h3 {
      color: rgb(20, 16, 49);
      margin-left: 96px;
    }
    h3:hover {
      cursor: pointer;
    }
  }

  .right {
    display: flex;
    align-items: center;
    .md-button {
      margin: 0;
      color: #000;
    }

    span {
      color: #000;
    }
  }
  @media only screen and (max-width: 1400px) {
    .right {
      padding-right: 650px;
    }
  }
  @media only screen and (max-width: 1200px) {
    .right {
      padding-right: 576px;
    }
  }
  @media only screen and (max-width: 992px) {
    .right {
      padding-right: 498px;
    }
  }
  @media only screen and (max-width: 768px) {
    .right {
      padding-right: 20px;
    }
  }

  @media only screen and (max-width: 600px) {
    .left {
      h3 {
        margin-left: 48px !important;
      }
    }
  }
}
</style>
