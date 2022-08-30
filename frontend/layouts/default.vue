<template>
  <div class="container gradient" @mousemove="getMouse" :style="outputValue">
    <div>
      <div class="dot" :style="dotStyle" ref="dot"></div>
      <nav v-if="pages.length > 1">
        <p v-if="$fetchState.pending">Loading...</p>
        <ul v-else>
          <li v-for="page in pages" :key="page.id">
            <NuxtLink
              :to="`/${page.slug}`"
              :class="[page.slug === $route.params.slug && 'current', 'link']"
              v-if="!page.parent"
              >{{ page.title }}</NuxtLink
            >
            <ul class="column" v-if="page.children">
              <li v-for="second in page.children" :key="second.id">
                <NuxtLink
                  :to="`/${page.slug}/${second.slug}`"
                  :class="[
                    second.slug === $route.params.slug && 'current',
                    'link',
                  ]"
                  v-if="!page.parent"
                  >{{ second.title }}</NuxtLink
                >
                <ul class="column" v-if="second.children">
                  <li v-for="third in second.children" :key="third.id">
                    <NuxtLink
                      :to="`/${page.slug}/${second.slug}/${third.slug}`"
                      :class="[
                        third.slug === $route.params.slug && 'current',
                        'link',
                      ]"
                      v-if="!page.parent"
                      >{{ third.title }}</NuxtLink
                    >
                    <ul class="column" v-if="second.children">
                      <li v-for="fourth in third.children" :key="fourth.id">
                        <NuxtLink
                          :to="`/${page.slug}/${second.slug}/${third.slug}/${fourth.slug}`"
                          :class="[
                            fourth.slug === $route.params.slug && 'current',
                            'link',
                          ]"
                          v-if="!page.parent"
                          >{{ fourth.title }}</NuxtLink
                        >
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <LocalNavigation
        :data="page.localNavigation"
        @click="changeGrad()"
        :styleBtn="outputValue"
      />
      <pre v-if="debug">
    <!-- default: {{ defaultGrad }} -->
    outputGrad: {{ outputGrad }}
    outputValue: {{ outputValue }}
    <!-- outputColors: {{ outputColors }} -->
     </pre>
      <pre v-if="debug">
      {{ mousePosition }}
      {{ dotStyle }}
    </pre
      >

      <main>
        <Nuxt />
      </main>
      <Footer />
    </div>
  </div>
</template>

<script>
import gsap from "gsap";
import LocalNavigation from "@c/Navigation/LocalNavigation";
import Footer from "@c/Blocks/Footer";
import { pagesQuery as slugs } from "@gql/queries";

export default {
  name: "DefaultLayoutPage",
  components: {
    LocalNavigation,
    Footer,
  },
  async asyncData({ params }) {
    const slug = params.slug;
    const childSlug = params.child;
    const parentSlug = params.parent;
    return { slug, parentSlug, childSlug };
  },
  async fetch() {
    const { data } = await this.$graphql({
      query: slugs,
    });
    const pages = data.entries;
    this.pages = pages;

    const landingPage = pages.filter((x) => {
      return x.slug === "landing-page";
    });
    this.page = landingPage[0];
  },
  data: () => ({
    pages: {},
    page: {},
    colors: {},
    defaultGrad: "",
    outputGrad: "",
    outputValue: "",
    outputColors: [
      "hsla(329, 100%, 82%, 0.93)",
      "hsla(206, 100%, 52%, 1)",
      "hsla(329, 100%, 82%, 1)",
      "hsla(206, 100%, 84%, 0.76)",
      "hsla(329, 100%, 92%, 0.63)",
    ],
    mouseDirection: {
      x: "",
      y: "",
    },
    reveals: "",
    mousePosition: 0,
    oldX: 0,
    oldY: 0,
    mouseX: 0,
    mousey: 0,
    dotStyle: "",
    debug: false,
  }),
  methods: {
    // async moveGradient(e) {
    //   await this.getMouse(e);
    //   await this.keepMoving();
    // },
    dotFollow(e, direction) {
      if (direction.x === "left" && e.pageX <= this.mousePosition.x) {
        this.mouseX = e.pageX - 50;
      }
      if (direction.x === "right" && e.pageX >= this.mousePosition.x) {
        this.mouseX = e.pageX + 50;
      }
      if (direction.y === "up" && e.pageY <= this.mousePosition.y) {
        this.mouseY = e.pageY - 50;
      }
      if (direction.y === "down" && e.pageY >= this.mousePosition.y) {
        this.mouseY = e.pageY + 50;
      }

      let x = (this.mouseX * 100) / window.innerWidth;
      let y = (this.mouseY * 100) / window.innerHeight;
      this.dotStyle = `transition: 3s ease-in-out; left: ${x}%; top: ${y}%`;
      return { x, y };
    },
    getMouse(e, el) {
      this.mousePosition = {
        x: window.innerWidth - Math.round(e.pageX),
        y: window.innerHeight - Math.round(e.pageY),
      };
      this.getMouseDirection(e);
      const { x, y } = this.dotFollow(e, this.mouseDirection);
      this.changeAngle(el, x, y);
    },
    // GET RANDOM HEX COLORS ON CLICK
    // randomColor() {
    //   let hexString = "0123456789abcdef";
    //   let hexCode = "#";
    //   for (let i = 0; i < 6; i++) {
    //     hexCode += hexString[Math.floor(Math.random() * hexString.length)];
    //   }
    //   return hexCode;
    // },
    getMouseDirection(e) {
      // GET WHICH DIRECTION THE MOUSE IS GOING
      //deal with the horizontal case
      this.oldX < e.pageX
        ? (this.mouseDirection.x = "right")
        : (this.mouseDirection.x = "left");
      //deal with the vertical case
      this.oldY < e.pageY
        ? (this.mouseDirection.y = "down")
        : (this.mouseDirection.y = "up");

      this.oldX = e.pageX;
      this.oldY = e.pageY;
    },
    changeGrad() {
      let color1 = [
        { x: 94, y: 6, color: "hsla(329, 100%, 82%, 0.93)" },
        { x: 93, y: 10, color: "hsla(206, 100%, 52%, 1)" },
        { x: 3, y: 79, color: "hsla(329, 100%, 82%, 1)" },
        { x: 4, y: 5, color: "hsla(206, 100%, 84%, 0.76)" },
        { x: 53, y: 59, color: "hsla(329, 100%, 92%, 0.63)" },
      ];
      // let color2 = [];
      // let color3 = [];
      let angle = Math.floor(Math.random() * 360);
      // this.outputGrad = `linear-gradient(${angle}deg, ${color1}, ${color2}, ${color3})`;
      this.outputGrad = color1.forEach((c) => {
        `
              radial-gradient(
              at ${c.x + angle}% ${c.y + angle}%,
              ${c.color} 0px,
              transparent 50%
            )
        `;
      });
      this.outputValue = `background-image: ${this.outputGrad};`;

      this.outputColors = `${color1}`;
    },
    changeAngle(el, x, y) {
      // console.log("changing angle to: ", x, y);
      let color1 = [
        { x: 94, y: 6, color: "hsla(329, 100%, 82%, 0.93)" },
        { x: 93, y: 10, color: "hsla(206, 100%, 52%, 1)" },
        { x: 3, y: 79, color: "hsla(329, 100%, 82%, 1)" },
        { x: 4, y: 5, color: "hsla(206, 100%, 84%, 0.76)" },
        { x: 53, y: 59, color: "hsla(329, 100%, 92%, 0.63)" },
      ];
      this.outputGrad = color1.forEach((c) => {
        `
              radial-gradient(
              at ${c.x + x}% ${c.y + y}%,
              ${c.color} 0px,
              transparent 50%
            )
        `;
      });
      this.outputValue = `transition: 3s ease-in-out; background-image: ${this.outputGrad};`;

      gsap.to(".container", {
        duration: "2s",
        backgroundImage: `${this.outputGrad}`,
        ease: "sine.o'ut",
      });
    },
  },
};
</script>

<style>
:root {
  --primary-color: #00c58e;
}

html {
  scroll-behavior: smooth;
}

body {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto,
    Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji,
    Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
  margin: 0;
  color: #ffffff;
}

.dot {
  height: 3em;
  width: 3em;
  background: black;
  border-radius: 50% 50%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: 0;
}
.container {
  /* border: 1px solid #999999; */
  /* border-radius: 0.5em; */
  /* margin: 1em 0; */
  width: 100%;
}

.outputValue {
  width: 100%;
}

a {
  color: inherit;
  text-decoration: none;
}
nav a:hover {
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}

.current {
  background-color: lightblue;
}

/* GRADIENT ANIMATION */

.gradient {
  background-color: hsla(142, 0%, 100%, 1);
  background-image: radial-gradient(
      at 95% 77%,
      hsla(329, 100%, 82%, 0.93) 0px,
      transparent 50%
    ),
    radial-gradient(at 94% 10%, hsla(206, 100%, 52%, 1) 0px, transparent 50%),
    radial-gradient(at 3% 79%, hsla(329, 100%, 82%, 1) 0px, transparent 50%),
    radial-gradient(at 4% 5%, hsla(206, 100%, 84%, 0.76) 0px, transparent 50%),
    radial-gradient(at 53% 59%, hsla(329, 100%, 92%, 0.63) 0px, transparent 50%);
  background-size: 300%;
  animation: 4000ms ease infinite alternate moveradialgradient;
  /* animation: 3000ms ease-in-out infinite alternate movegradient; */
  /* animation-name: movegradient;
  animation-timing-function: ease-in-out;
  animation-fill-mode: alternate;
  animation-iteration-count: infinite; */
}

@keyframes moveradialgradient {
  0% {
    background-position: 95% 45%;
  }
  100% {
    background-position: 3% 2%;
  }
}

@keyframes movegradient {
  0% {
    background-position: top right;
    rotate: 0;
  }
  100% {
    background-position: left bottom;
    rotate: 399;
  }
}
img {
  margin-bottom: 1rem;
}

.center {
  display: flex;
  justify-content: center;
}

ul {
  list-style-type: none;
  padding: 0 0.5em;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}
ul.column {
  flex-direction: column;
}
li {
  margin: 0 0.5rem;
  padding: 0.25rem;
  font-size: 1.2rem;
}
nav {
  margin: 0;
}
.align-left {
  text-align: left;
}
.align-right {
  text-align: right;
}
</style>
