<template>
  <el-config-provider namespace="ep" :locale="locale">
    <upload />
  </el-config-provider>
</template>

<style>
#app {
  text-align: center;
  color: var(--ep-text-color-primary);
}
</style>

<script lang="ts">
  // 下面是按需导入引入语言包的方式，如果是全量导入，则此script块都可以去掉
  // start
  import { defineComponent } from 'vue'
  import { ElConfigProvider } from 'element-plus'

  import zhCn from 'element-plus/lib/locale/lang/zh-cn'

  export default defineComponent({
    components: {
      ElConfigProvider,
    },
    setup() {
      return {
        locale: zhCn,
        size: 'large'
      }
    },
  })
  // end
</script>