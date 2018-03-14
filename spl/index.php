<?php
$queue = new SplQueue();

$queue ->setIteratorMode(SplDoublyLinkedList::IT_MODE_KEEP);

$queue -> enqueue(['dsf','er']);
var_dump($queue ->dequeue());


$heap = new SplMaxHeap();

$heap->insert('2');
$heap->insert('5');
$heap->insert('1');


echo $heap->count();
echo $heap->current();
echo $heap->top();
echo $heap->next();
echo $heap->current();

