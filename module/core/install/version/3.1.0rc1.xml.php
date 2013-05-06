<upgrade>
	<settings>
		<setting>
			<group>cdn_content_delivery_network</group>
			<module_id>core</module_id>
			<is_hidden>0</is_hidden>
			<type>boolean</type>
			<var_name>enable_amazon_expire_urls</var_name>
			<phrase_var_name>setting_enable_amazon_expire_urls</phrase_var_name>
			<ordering>9</ordering>
			<version_id>3.1.0rc1</version_id>
			<value>0</value>
		</setting>
		<setting>
			<group>cdn_content_delivery_network</group>
			<module_id>core</module_id>
			<is_hidden>0</is_hidden>
			<type>integer</type>
			<var_name>amazon_s3_expire_url_timeout</var_name>
			<phrase_var_name>setting_amazon_s3_expire_url_timeout</phrase_var_name>
			<ordering>10</ordering>
			<version_id>3.1.0rc1</version_id>
			<value>60</value>
		</setting>
	</settings>
	<phpfox_update_settings>
		<setting>
			<group>server_settings</group>
			<module_id>core</module_id>
			<is_hidden>0</is_hidden>
			<type>boolean</type>
			<var_name>cache_js_css</var_name>
			<phrase_var_name>setting_cache_js_css</phrase_var_name>
			<ordering>8</ordering>
			<version_id>2.0.0alpha1</version_id>
			<value>0</value>
		</setting>
	</phpfox_update_settings>
	<phrases>
		<phrase>
			<module_id>core</module_id>
			<version_id>3.1.0rc1</version_id>
			<var_name>setting_enable_amazon_expire_urls</var_name>
			<added>1332254480</added>
			<value><![CDATA[<title>Enable Amazon Expiring URLs</title><info>If this setting is enabled and "Amazon Expire Timeout" is higher than zero, all paths to images taken from Amazon S3 will include a signature set to expire.<br />
If this setting is enabled images uploaded to S3 will be set to private. If this setting is later disabled those images will remain private and they will not show on your site until you manually revert their privacy.</info>]]></value>
		</phrase>
		<phrase>
			<module_id>core</module_id>
			<version_id>3.1.0rc1</version_id>
			<var_name>setting_amazon_s3_expire_url_timeout</var_name>
			<added>1332254771</added>
			<value><![CDATA[<title>Amazon Expire Timeout</title><info>How many seconds will the urls to the images be valid for.</info>]]></value>
		</phrase>
	</phrases>
	<sql><![CDATA[a:1:{s:9:"ADD_FIELD";a:1:{s:11:"phpfox_menu";a:1:{s:11:"mobile_icon";a:4:{i:0;s:8:"VCHAR:50";i:1;N;i:2;s:0:"";i:3;s:3:"YES";}}}}]]></sql>
</upgrade>