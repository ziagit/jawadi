<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{
        'background-image': 'url(/images/uploads/carrier-bg.svg)',
      }"
    >
      <Header v-on:togal-menu="$emit('togal-menu')" :scrollValue="scrollValue" />
      <div class="content">
        <div class="md-display-1">Our Services</div>
        <div class="md-subheading">Join our networks by creating an account with us.</div>
        <div class="break"></div>
        <div class="break"></div>
        <md-button class="custom-button" to="/register">Sign Up</md-button>
      </div>
    </div>

    <md-card class="section1">
      <div class="wrapper">
        <div class="left">
          <div>
            <div class="md-display-1">Access thousands of shipments a day.</div>
            <div class="md-body-1">
              We understand service to our customers is only as good as our network of
              contract carriers. We value our carriers and have invested in technology to
              best support their needs. Our proprietary technology, developed and managed,
              matches your equipment with our available customer loads. You tell us where
              your trucks are, and we’ll match you with our opportunities. Whether you’re
              looking for a load to get home or consistent freight to fill daily and
              weekly runs, our network has access to thousands of available loads to keep
              you busy and profitable.
              <br /><br />
              <div class="md-title">
                There are benefits when you’re a contract carrier for Shipping TAP
              </div>
              <ul>
                <li>Get access to our loads</li>
                <li>
                  Receive fast payments or choose QuickPay to get your money even sooner
                </li>
                <li>Find freight with a free mobile app</li>
                <li>Strengthen your efficiencies with a Carrier AdvantageTM Program</li>
                <li>Build a relationship with your single point of contact</li>
                <li>Keep your business moving with technology created for carriers</li>
              </ul>
              <md-button class="custom-button">Create Account</md-button>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="download-app">
            <div class="md-title">Download our Application</div>
            <div class="md-body-1">
              By downloading our application the task will be much easier.
            </div>
            <div>
              <md-button class="custom-button" to="https://play.google.com"
                >Download</md-button
              >
            </div>
          </div>
        </div>
      </div>
    </md-card>
    <div class="section2">
      <div class="rows">
        <div class="row">
          <img :src="'/images/uploads/carrier-tech.svg'" width="30" alt="" />
          <div>
            <div class="md-title">Technology</div>
            <div class="md-body-1">Easy to use tools to find freight.</div>
          </div>
        </div>
        <div class="row">
          <img :src="'/images/uploads/carrier-payment.svg'" width="30" alt="" />
          <div>
            <div class="md-title">Payment</div>
            <div class="md-body-1">
              Get paid fast with options to further speed the process.
            </div>
          </div>
        </div>
        <div class="row">
          <img :src="'/images/uploads/carrier-freight.svg'" width="50" alt="" />
          <div>
            <div class="md-title">Programs</div>
            <div class="md-body-1">Personalized service and more opportunities.</div>
          </div>
        </div>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
export default {
  name: "ContactUs",
  props: ["scrollValue"],
  data: () => ({
    form: {
      name: null,
      email: null,
      message: null,
    },
  }),
  methods: {},
  components: {
    Footer,
    Header,
  },
};
</script>

<style lang="scss" scoped>
.container {
  background: #fff;

  .section0 {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    align-items: center;
    border-bottom: #ddd 1px solid;
    .content {
      height: 268px;
      padding: 85px 200px 85px 106px;

      .md-display-1 {
        line-height: 60px;
        font-size: 53px;
        font-weight: 600;
        color: #000;
      }

      .md-subheading {
        color: #000;
        max-width: 70%;
      }
    }
  }

  .section1 {
    max-width: 1200px;
    margin: auto;
    padding: 30px;
    margin-top: -30px;
    margin-bottom: 30px;
    .wrapper {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;

      .left {
        flex: 60%;
        padding: 60px;

        .md-display-1 {
          font-weight: 500;
          line-height: 70px;
          color: #000;
        }

        .md-body-1 {
          font-size: 16px;
          line-height: 24px;
        }
      }

      .right {
        flex: 30%;
        padding: 82px 60px;

        .md-headline {
          font-size: 22px;
        }

        .md-icon {
          color: #66a9fb;
        }

        .qoute {
          .md-field {
            margin: 4px 0 8px;
          }

          .action {
            text-align: right;

            .md-button {
              margin: 0;
            }
          }
        }

        .qoute,
        .faq,
        .download-app,
        .privacy,
        .terms,
        .contact {
          margin-bottom: 30px;
        }

        .download-app {
          .md-button {
            margin-top: 20px;
          }
        }
      }
    }
  }

  .section2 {
    padding: 0 100px 46px 100px;

    .rows {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;

      .row {
        flex: 30%;
        padding: 30px;
        border: solid 1px #ddd;
        border-radius: 3px;
        margin: 10px;
        text-align: center;

        .md-title {
          line-height: 52px;
          font-weight: 600;
          line-height: 44px;
        }
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .section0 {
    .content {
      padding: 20px !important;
      height: 188px !important;
      .md-display-1 {
        font-size: 32px !important;
        line-height: 48px !important;
      }
      .md-subheading {
        font-size: 14px !important;
      }
    }
  }

  .section1 {
    padding: 30 !important;

    .wrapper {
      flex-direction: column;
      .left,
      .right {
        padding: 0 !important;
      }
      .left {
        margin-bottom: 74px !important;
      }
      .md-button {
        margin: 30px 0 0 0;
      }
    }
  }
  .section2 {
    padding: 44px !important;
  }
}
</style>
