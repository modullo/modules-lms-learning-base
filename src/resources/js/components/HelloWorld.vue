<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="">
          <button class="btn btn-primary leftLst"><</button>
          <button class="btn btn-primary rightLst" @click="press">></button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <br/><br/><br/>
          <hr/>
          <p>Ok jhaad</p>
          <p>Change data items for xs,sm,md and lg display items respectively. Ex:data-items="1,3,5,6"</p>
          <p>Change data slide for slides per click Ex:data-slidsse="1"</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods:{
    press(){
      console.log('Pressing')
    }
  }
}
</script>