# falcon
The project is developed with PHP YAF framework and python


#现在框架是用YAF

#YAF是一个轻量级的MVC框架，类库由自己定义，免去不必要多余的类

#MVC层面增加多了一个DAO层专门处理数据层，Model层处理业务逻辑

#Model之间原则上是不能互相调用，只处理业务逻辑，但如果有业务逻辑是必须要调用其他Model的可以调用，每个Model的方法只处理对应的业务逻辑，如果是多逻辑的出现责有Controller层协调