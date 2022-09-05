import { createApp } from "vue";
import App from "./App.vue";
// 全量导入取消注释
//import ElementPlus from 'element-plus'
//import zhCn from 'element-plus/es/locale/lang/zh-cn'

import 'element-plus/dist/index.css'
// 已经配置在 vite.config.ts，故注释
//import "~/styles/element/index.scss";

import "~/styles/index.scss";
import 'uno.css'

// If you want to use ElMessage, import it.
// 全量导入取消注释
//import "element-plus/theme-chalk/src/message.scss"

const app = createApp(App);
// 全量导入取消注释
//app.use(ElementPlus, { locale: zhCn, size: 'small', });

app.mount("#app");
