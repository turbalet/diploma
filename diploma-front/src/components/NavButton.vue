<template>
  <!--
  <li class="mainmenuItem"><a class="mainmenuLink" href="#" title="Home" v-for="nava of navs" v-bind=nava='nava'></a>
  </li>-->
</template>

<script>
export default {
  props:['navs'],
  name: "NavButton"
}
</script>

<style scoped>
.mainmenuItem{
  font-size: 14px;
  display: inline-block;
  padding:8px;
  position: relative;
  line-height:2em;
  background: white;
  color: #FFF;
}
.mainmenuItem a {
  text-decoration: none;
  color: black;
}
.mainmenuItem:hover:after {
  content:'';
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid blue;
  position: absolute;
  bottom:0;
  left:50%;
  margin-left: -5px;
}
.mainmenuLink{
  font-family:FrutigerCELight,Arial,Helvetica,sans-serif;
  text-decoration: none;
  font-size:14px;
}

</style>