<?php
return[	
		//应用ID,您的APPID。
		'app_id' => "2016100100636202",
		'seller_id' =>"2088102178041785",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAuL09RlM+53xe6FEuocHmJNBbxmJJqEPjYyaFfIQ8Zm0NyP6QwazRVFoDB9D0yss2jNSkK/cuVyr/j9kpkeiaH/mlhl16CMtbrJFSpn2Qw0GsWRLh+OXjZGD2kUFRtIQm9Mbw+1KbYiiv0DplgjHPS7iene1SUwTgSawBmXAyk8SgVoeFkHoJPGXNAzeNBMNCifm2D/BaUDaTErIdEb0iR7rfHxzxhtV0NCwYuFj1Vv+xg686KA1dBahAaLLyFGJKN3sBUfsFuPXppn2rh+t5GHPrk4BzvsELy8ENFV/5xb7U0LL/scKrZ4wAy6xLlWgz9CwDKKFdVS8aT3B51MSZBwIDAQABAoIBAQCweLVr1GGmp3vR2Jr/EkZSrGa+320VO6SfNlEVXQyFm28rrWGCYR+lwEZc1RLCFdUKOqaJCRpPUlfGhd/b7aItIUEpVWoZtIjiFAAr4o7Ctp14iT0rkg7h+G4Q26C9G/BKqy/QJF0iK1OnSeFluUcYQkfi/K1DeMj4F0N/21m1JOMfBFOQaQaLAcIstgD5lPoml3jNWcUsuCLcsSjxVrX+Rk1RyQdcwPf2UfPy/MEz2nZTwCj4wSBXSfLeP3iJP8JQZTyf6MAN+oCn68Fuad73mSE6ME8/2yEogWVazXMBIbl6391BOnAp97Ac8ssuzOhow0AObgcGjIdJcYgBI77BAoGBAOWIDK1V3uK2VzAhmWEgP/isvLqxtDj3MtQAMebtvmgfOrnVhDlbCxcLEW1TJpe6IawJmV4+kO2FpmES2Bl8ZoL1Q9BSs/9KYNvIqczTZCn+/+kpVMbwDLiGIuXt0fH31E8zz/rWFM9gUuNQLTU/oHkQt9SNCpSzORg6UuuWA2W/AoGBAM4K40F7WAKaofdbYIQOsGKhURINNY+VDhXoM7yh2HR9mowSue9zHv2wXe+Ip8YdH0aqfcVNoUyb/AICzUqQlssaE/A4OeQJ8eJt6a8yO7f5HYtKg5IMDIiDx4ta+BSZ5geMdYaxnFoe+UhRdscH57olRmE1ct/n7+ZIxE6faG65AoGBAJPX5vp7Fh6Hfm9VJPtHj4z4jnPeZIxQxV+CZKIvPnbIrsXmPs3G08Ta7zWw2mnejTPH1w66VBV6AaoDPkhkNY9itXRo4OGuIedPP/fbrWfThTjE04N0OW1dkPrzDUjC7fC6GduiqzLMA3fBO+1Rd2ajmxUAZ/FR45O0dZajQLr3AoGAMCvHedW2e9VfLI+GfxlYD5cbdxbzgMAebOy+u8ky6/k5mqn+IodNpY4ISCow31aLq1/My8YcgeauAmJZUKeBOba9Fppunmvcy01bJwSdhaOOTrR7EjgS7g+xJVl9SoO4jec+yuDXZxJ6wXeaR2oHuTNhwvRWCRcWtUYp7x/BsLECgYEAy5BQmDQbeFBQD3c0DeSd0JOlJjdCvfs1/V9DjsX6S24Ggv68+sQK0hUg4P8WX6oENci4X4Xyl7QCGeQR2BuvF1ti7aaFs48Cj9LOWy8Gg91b7BNY42c6goKeGDTH+aiktfRf8/3M9bEmjI/xCtvuVMSrKalfGF+7YulAmQO+OSU=",
		
		//异步通知地址
		'notify_url' => "http://www.laravel.com/pay/yipay",
		
		//同步跳转
		'return_url' => "http://www.laravel.com/pay/tongpay",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAoddyHZRORhMimEVycaLpDBC1TjufFAGCRAPd0QJ+o6nW0mrJs8eV34v35i15w8vKXrQ1jje+eFUvu0Nhtm9Pjc6WPFZ3Pl903ICeRFDHtVubryHc34w1VuAm9CvN2SPbCLULJPesDSTZMKY9VakNAH+Yxn4RuGe/bpzd3+pHXEKJVEn52nFCkbjbvv8+B/rUaDFcJ5VGKsKhCdoAkXRCX6ayx9MH87FD9GcsLaEHW48Vk+rxTRHJX3lGRFeBX128xK9Q7B0iPGh0xhS8megJL4/H3aQqNJwcOCzOvDUwFu2cQrckOVFkh1Q5+ikRjjoJx2ccTu/pq2uPm/Ku9hRVgQIDAQAB",
];