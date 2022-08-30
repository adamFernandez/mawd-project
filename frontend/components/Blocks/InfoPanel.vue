<template>
  <div class="infoPanel">
    <div class="title">
      Title<span><a href="#" class="close-it">close</a></span>
    </div>
    <div class="info">
      <div class="data">Info data</div>
      <button class="visit">Visit Mawd</button>
    </div>
  </div>
</template>
<style>
.infoPanel {
  color: black;
  position: sticky;

  top: 3em;
  left: 50%;
  z-index: 2500;
  width: 50%;
}
.title {
  display: flex;
  justify-content: space-between;
  background: white;
  margin-bottom: 1em;
  padding: 1em;
}
.info {
  background: white;
  margin-bottom: 1em;
  padding: 1em;
}
.visit {
  width: 100%;
}
</style>
