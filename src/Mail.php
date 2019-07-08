<?php
/**
 * Created by PhpStorm.
 * User: danielshen
 * Date: 2019/7/8
 * Time: 16:53
 */

namespace Shencongcong\Mail;

class Mail
{
    protected $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function send($to_user,$subject,$content)
    {

        // 判断是否使用html类型
        $type = $this->config['html'] ? 'Content-type: text/html;' : 'Content-type: text/plain;';
        $cmd = [
            "EHLO {$this->config['smtp_name']}\r\n",
            "AUTH LOGIN\r\n",
            base64_encode($this->config['smtp_user'])."\r\n",
            base64_encode($this->config['smtp_pass'])."\r\n",
            "MAIL FROM: <{$this->config['smtp_user']}>\r\n",
            "RCPT TO: <{$to_user}>\r\n",
            "DATA\r\n",
            "From: \"{$this->config['smtp_name']}\"<{$this->config['smtp_user']}>\r\n",
            "To: <{$to_user}>\r\n",
            "Subject:{$subject}\r\n",
            $type."\r\n",
            "\r\n",
            $content." \r\n",
            ".\r\n",
            "QUIT\r\n",
        ];
        $this->connect($cmd);
        return true;
    }
    // 链接 发送
    protected function connect($cmd)
    {
        //打开smtp服务器端口
        $fp = @pfsockopen($this->config['smtp_host'], $this->config['smtp_port']);
        $fp or die("Error: Cannot conect to ".$this->config['smtp_host']);
        // 执行命令
        foreach ($cmd as $k => $v) {
            @fputs($fp, $v );
            // ************ 打印 ***********
            $res= fgets($fp);
            echo "\n {$v} {$res} \n";
            // *****************************
            // sleep(1);
            // 延迟 0.5秒
            usleep(500000);
        }
    }
}
