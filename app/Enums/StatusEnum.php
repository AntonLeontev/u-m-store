<?php


namespace App\Enums;

class StatusEnum
{
    public  const CREATED = 'CREATED';
    public  const FAILED = 'FAILED';
    public  const CONFIRMED = 'CONFIRMED';
    public  const DECLINED = 'DECLINED';

//    Самовывоз
    public  const SELF_DELIVERY = 'SELF_DELIVERY';
//    Доставка на адрес
    public  const DELIVERY = 'DELIVERY';

//'Формирование заказа'
    public  const ORDERED = 'ordered';
//'Заказ оплачен'
    public  const PAYED = 'payed';
//'Заказ доставлен'
    public  const DELIVERED = 'delivered';
//'Заказ отменён'
    public  const CANCELED = 'canceled';

// Бонусы

public const BUYED = 'buyed'; // получено бонусов
public const USED = 'used'; // использовано
public const FINISHED = 'finished'; // закончился срок действия бонуса


}
