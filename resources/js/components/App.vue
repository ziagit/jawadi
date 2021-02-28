<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style lang="scss">
.pac-icon {
  display: none !important;
}
.pac-item {
  padding: 8px 8px 8px 12px !important;
  font-size: 14px !important;
  cursor: pointer;
}
.pac-item:hover {
  background: #ececec;
}
.pac-item-query {
  font-size: 14px !important;
}

.section0 {
  box-shadow: 0 2px 13px -7px grey;
}
.md-stepper-label {
  color: #000 !important;
  font-weight: 600;
}
.md-steppers {
  background: none !important;
}
.break {
  min-height: 10px;
}
.tab {
  width: 30px;
}
.md-app-container {
  transform: none !important;
}

.app {
  height: 100% !important;
}

.padding-20 {
  padding: 20px !important;
}
.md-tabs-navigation {
  padding-left: 60px !important;
}

.info,
.question:hover {
  cursor: pointer;
}

.pagination {
  display: flex;

  li {
    list-style-type: none !important;
    margin: 5px 10px;
  }
}

.line {
  color: #ddd;
}

.md-table-content {
  max-width: calc(100vw - 80px);
  overflow-x: auto !important;
}

.md-body-1 {
  width: 100% !important;
}

.md-list-item {
  .md-list-item-button {
    font-size: 14px !important;

    .md-list-item-content {
      min-height: 35px !important;
    }
  }
}

.hidden-input {
  position: absolute;
  opacity: 0;
  z-index: -1;
}

.company-detail {
  .md-table-cell-container {
    width: 150px !important;
    white-space: nowrap !important;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
.custom-button {
  border-radius: 100px !important;
  padding: 0 30px !important;
  text-transform: none !important; /*For Lower case use lowercase*/
}

@media only screen and (min-width: 600px) {
  .md-display-1 {
    font-size: 30px;
  }

  label {
    font-size: 14px;
  }
}

@media only screen and (max-width: 600px) {
  .section3 {
    .steps {
      .md-list {
        .md-list-item-content {
          padding: 0 !important;

          .md-headline {
            font-size: 14px !important;
          }

          .details {
            font-size: 10px !important;
          }
        }
      }
    }
  }
}
</style>
