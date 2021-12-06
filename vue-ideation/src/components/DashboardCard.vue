<template>
  <div>
    <div class="card">
      <div class="logo">
        <div class="circle">
          <slot name="logo"></slot>
        </div>
      </div>
      <div class="title">
        <slot name="title"></slot>
      </div>
      <div class="content">
        <slot name="content"></slot>
      </div>
      <div class="Goals"></div>
    </div>
  </div>
</template>

<style scoped lang = 'scss'>
.card {
  height: 200px;
  width: 300px;
  background: #fff;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.16), 0 5px 8px rgba(0, 0, 0, 0.23);
  border-radius: 30px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);

  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
}

.logo,
.title,
.content {
  margin-left: 15px;
}

.title {
  color: #9fa2b4;
}

.logo {
    padding-top: 10px;
    .circle{

    }
  
}
</style>