<template>
  <nav class="navbar">
    <!-- LOGO -->
    <div class="logo">
      <img alt="logo" class="logotip" src="../assets/logo.png" />
    </div>
    <div class="menu">
      <li><a href="/">О НАС</a></li>
      <li><a href="/">РЕЙТИНГ</a></li>
      <li><a href="/">ВУЗЫ</a></li>
      <li><a href="/">СПЕЦИАЛЬНОСТЬ</a></li>
      <li><a href="/">НОВОСТИ</a></li>
      <li><input type="search"></li>
      <li></li>
    </div>
  </nav>

</template>

<script>
export default {
  name: "Header"
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: cursive;
}
a {
  text-decoration: none;
}
li {
  list-style: none;
}
li input[type=search]{
  border-radius: 5px;
  float: right;
  padding: 6px;
  border: none;
  margin-right: 16px;
  font-size: 17px;
}
.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
  background-color:seagreen;
  color: #fff;
}
.nav-links a {
  color: #fff;

}
/* LOGO */
.logo {
  height: 40px;
}
.logotip{
  height: 40px;
}
/* NAVBAR MENU */
.menu {
  display: flex;
  gap: 1em;
  font-size: 18px;
}
.menu li:hover {
  background-color: #4c9e9e;
  border-radius: 5px;
  transition: 0.3s ease;
}
.menu li {
  padding: 5px 14px;


}

.services:hover .dropdown {
  display: block;
}

</style>