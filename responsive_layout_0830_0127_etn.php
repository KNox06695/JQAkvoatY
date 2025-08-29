<?php
// 代码生成时间: 2025-08-30 01:27:05
// 使用CakePHP框架的布局文件
// 确保你的视图文件继承了此布局文件

// 引入HTML和CSS相关的Helper
$this->extend('/Common/base');

// 开始响应式布局
echo $this->Html->css('bootstrap.min', ['block' => 'css']);
echo $this->Html->css('responsive-layout', ['block' => 'css']);

// 设置视图的meta标签，确保在移动设备上的响应式行为
echo $this->Html->meta('icon');

// 设置视图的title
echo $this->Html->title('响应式布局示例');

// 开始主体内容
echo $this->fetch('content');

// 结束布局
$this->end();

// 引入JavaScript相关的Helper
echo $this->Html->script('jquery.min', ['block' => 'script']);
echo $this->Html->script('bootstrap.min', ['block' => 'script']);

// 以下是responsive-layout.css的内容
?>
<!-- responsive-layout.css -->
<style>
  /* 响应式布局样式 */
  @media (max-width: 768px) {
    .responsive {
      width: 100%;
      padding: 0;
    }
  }
  
  @media (min-width: 769px) and (max-width: 992px) {
    .responsive {
      width: 75%;
      padding: 0 12.5%;
    }
  }
  
  @media (min-width: 993px) and (max-width: 1200px) {
    .responsive {
      width: 60%;
      padding: 0 20%;
    }
  }
  
  @media (min-width: 1201px) {
    .responsive {
      width: 50%;
      padding: 0 25%;
    }
  }
</style>