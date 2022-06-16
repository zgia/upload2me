<template>
  <el-upload ref="uploadRef" class="upload-2-me" action="http://localhost:8909/index.php" :on-remove="handleRemove"
    :before-remove="beforeRemove" :on-change="handleChange" :before-upload="handleBeforeUpload" :on-error="handleError"
    multiple :auto-upload="false">
    <template #trigger>
      <el-button type="primary">选择文件</el-button>
    </template>

    <el-button class="ml-3" type="success" @click="submitUpload">
      上传
    </el-button>

    <el-button circle @click="toggleDark()">
      <i inline-flex i="dark:ep-moon ep-sunny" />
    </el-button>

    <template #tip>
      <div class="el-upload__tip">
        单个文件的大小不能超过100M
      </div>
    </template>
  </el-upload>
</template>
<script lang="ts" setup>
import { ref } from 'vue'
import { ElMessage, ElMessageBox } from 'element-plus'
import type { UploadProps, UploadInstance } from 'element-plus'
import { toggleDark } from '~/composables';

const handleRemove: UploadProps['onRemove'] = (uploadFile, uploadFiles) => {
  console.log(uploadFile)

  ElMessage(`已经移除文件 ${uploadFile.name} 。`)
}

const beforeRemove: UploadProps['beforeRemove'] = (uploadFile, uploadFiles) => {
  return ElMessageBox.confirm(
    `移除上传文件 ${uploadFile.name} ?`, { type: 'info' }
  ).then(
    () => true,
    () => false
  )
}

// 文件最大100M
let maxSize = 100

const byte2mb = (bytes: number) => {
  return bytes / 1024 / 1024
}

const handleChange: UploadProps['onChange'] = (uploadFile, uploadFiles) => {
  if (byte2mb(uploadFile.size) > maxSize) {
    ElMessage.error(`文件 ${uploadFile.name} 大小超过 ${maxSize}M 限制。`)
  }
}

const handleBeforeUpload: UploadProps['beforeUpload'] = (rawFile) => {
  if (byte2mb(rawFile.size) > maxSize) {
    ElMessage.error(`文件 ${rawFile.name} 大小超过 ${maxSize}M 限制。`)
    return false
  }
  return true
}

const handleError: UploadProps['onError'] = (error) => {
  ElMessage.error(error.message)
}

const uploadRef = ref<UploadInstance>()

const submitUpload = () => {
  uploadRef.value!.submit()
}
</script>

<style>
.upload-2-me {
  padding: 100px 0;
}

.ep-upload-list {
  padding: 10px;
}
</style>