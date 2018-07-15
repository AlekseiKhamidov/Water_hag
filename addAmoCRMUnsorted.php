<?php

    require_once "vendor/autoload.php";
    require_once "config.php";

    function postUnsorted($data, $url, $partner) {
        try {
            // Создание клиента
            $amo = new \AmoCRM\Client(AMO_SUBDOMAIN, AMO_LOGIN, AMO_HASH);

            $data = json_decode($data, true);
            $nameKey = array_search('name', array_column($data, 'id'));
            $phoneKey = array_search('phone', array_column($data, 'id'));
            $emailKey = array_search('email', array_column($data, 'id'));
            $courseKey = array_search('course', array_column($data, 'id'));
            $priceKey = array_search('price', array_column($data, 'id'));
            $cityKey = array_search('city', array_column($data, 'id'));


            $unsorted = $amo->unsorted;
            $unsorted['source'] = 'www.aktivkredit.ru';
            $unsorted['source_uid'] = null;

            // Данные заявки (зависят от категории)
            $unsorted['source_data'] = [
                'data' => [
                    'name_1' => [
                        'type' => 'text',
                        'id' => 'name',
                        'element_type' => '1',
                        'name' => $data[$nameKey]['a'],
                        'value' => $partner,
                    ]
                ],
                'form_id' => 1525802566, // 302971
                'form_type' => 1,
                'origin' => [
                    'ip' => '92.53.96.181',
                    'datetime' => date(strtotime('now')),
                    'referer' => '',
                ],
                'date' => strtotime('now'),
                'from' => 'Новая анкета с сайта aktivkredit.ru',
                'form_name' => 'Форма обратной связи',
            ];
            // Сделка которая будет создана после одобрения заявки.
            $lead = $amo->lead;
            $lead['name'] = $data[$nameKey]['a'].' ('.$partner.')';
            $lead['price'] = $data[$priceKey]['a'];
            $lead['tags'] = ['aktivkredit.ru', $partner];
            
            $lead->addCustomField(AMO_LEADFIELD_PRODUCT, $data[$courseKey]['a']);
            

            // Примечания, которые появятся в сделке после принятия неразобранного
            $note = $amo->note;
            $note['element_type'] = \AmoCRM\Models\Note::TYPE_LEAD; // 1 - contact, 2 - lead
            $note['note_type'] = \AmoCRM\Models\Note::COMMON; // @see https://developers.amocrm.ru/rest_api/notes_type.php
            $note['text'] = $url;
            $lead['notes'] = $note;
            // Присоединение сделки к неразобранному
            $unsorted->addDataLead($lead);
            
            $contact = $amo->contact;
            $contact['name'] = $data[$nameKey]['a'];
             // Добавление ENUM кастомного поля
            $contact->addCustomField(AMO_CONTACTFIELD_PHONE, $data[$phoneKey]['a'], 'WORK');
            $contact->addCustomField(AMO_CONTACTFIELD_EMAIL, $data[$emailKey]['a'], 'WORK');
            
            $contact->addCustomField(AMO_CONTACTFIELD_CITY, $data[$cityKey]['a']);

            
            $unsorted->addDataContact($contact);

            // Добавление неразобранной заявки с типом FORMS
            $unsortedId = $unsorted->apiAddForms();
            print_r($unsortedId);
            
        } catch (\AmoCRM\Exception $e) {
            printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }
?>