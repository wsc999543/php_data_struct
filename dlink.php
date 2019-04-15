<?php
//节点元素
class Node {
	public $prev;
	public $next;
	public $data;
	public function __construct($data){
		$this->prev = NULL;
		$this->next = NULL;
		$this->data = $data;

	}
}
//双向链表类
class DLinklist{
	private $head;
	//初始化双向链表
	public function __construct(){
		//头结点指针指向第一个节点
		$this->head = NULL;
	}
	//是否为空
	public function is_empty(){
		return $this->head == NULL;
	}
	//获取链表长度
	public function get_length(){
		$length = 0;
		$cur = $this->head;
		while($cur){
			$cur = $cur->next;
			$length++;
		}
		return $length;
	}
	// 遍历链表
	public function travel_dlist(){
		$cur = $this->head;
		while($cur){
			var_dump($cur->data);
			$cur = $cur->next;
		}
	}
	//头部插入
	public function add($node){
		//空链表直接插入
		if($this->is_empty()){
			$this->head = $node;
		} else{
			$node->next = $this->head;
			$node->prev = $this->head;
			$this->head = $node;
		}
		return $this;
	}

	//尾部插入
	public function append($node){
		if($this->is_empty()){
			$this->head = $node;
		} else{
			//将指针移动到链表尾部插入
			$cur = $this->head;
			while($cur->next){			
				$cur = $cur->next;
			}
			$node->next = $cur->next;
			$cur->next = $node;
			$node->prev = $node;

		}
		return $this;
	}

	//任意位置插入
	public function insert_link($i, $node){
		//位置判断
		if($i<0 || $i>$this->get_length()){
			return false;
		}
		//定位i的位置指针
		$cur = $this->head;
		$j = 1;
		while($j < $i-1){			
			$cur = $cur->next;
			$j++;
		}
		$node->next = $cur->next;
		$node->prev = $cur;
		$cur->next = $node;
		return $this;
	
	}
	//删除节点
	public function del_node($i){
		//位置判断
		if($i<0 || $i>$this->get_length()){
			return false;
		}
		//定位i的位置指针
		$cur = $this->head;
		$j = 1;
		//找到前一个节点
		while($j < $i-1){			
			$cur = $cur->next;
			$j++;
		}
		$node = $cur->next;
		$cur->next = $cur->next->next;
		$cur->next->prev = $cur;
		return $node;

	}
	
	//更改节点
	public function modify_node($i, $node){
		//位置判断
		if($i<0 || $i>$this->get_length()){
			return false;
		}
		//定位i的位置指针
		$cur = $this->head;
		$j = 1;
		while($j < $i-1){			
			$cur = $cur->next;
			$j++;
		}
		$node_tmp = $cur->next;
		$node->next = $cur->next->next;
		$node->prev = $cur;
		$cur->next->next->prev = $node;
		$cur->next= $node;
		return $node_tmp;
	}

	//查找节点
	public function get_node($i){
		//位置判断
		if($i<0 || $i>$this->get_length()){
			return false;
		}
		//定位i的位置指针
		$cur = $this->head;
		$j = 0;
		while($j < $i-1){			
			$cur = $cur->next;
			$j++;
		}
		return $cur;
	}

}
$l = new DLinklist();
$l->add(new Node('1'))->add(new Node('2'))->add(new Node('3'));
$l->append(new Node('4'));
$l->insert_link(2, new Node('5'));
$l->travel_dlist();
echo "DEL NODE：".PHP_EOL;
$l->del_node(2);
$l->travel_dlist();
$l->modify_node(2, new Node('10'));
echo "modify NODE：".PHP_EOL;
$l->travel_dlist();
$node = $l->get_node(2);
echo "------"PHP_EOL;
var_dump($node->data);