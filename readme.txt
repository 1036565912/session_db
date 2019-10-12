     一般重写session的驱动只需要两个方法，一个就是读方法， 一个就是写方法。其余的可以不用重写 ，但是要修改php.ini的配置信息，把session的驱动改为user代替file。而删除方法可以删除更加彻底，cookie、session数据区和session全局数据组的所有数据都删除掉。
     使用redis来重写session驱动，只需要修改php.ini的两个配置就可以。
     tip:无论是db、redis、memcache在作为驱动的时候，都是以cookie存储的session_id.值存储的是键值对的序列化数据。

    
