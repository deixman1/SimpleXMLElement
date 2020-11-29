<?php
$xmlstr = <<<XML
<?xml version='1.0'?>
<items>
    <item name="name1" name1="name_second">
        <item name="name1.1">value1.1</item>
        <item name="name1.2">value1.2</item>
        <item name="name1.3">
            <item name="name1.3.1">value1.3.1</item>
            <item name="name1.3.2">value1.3.2</item>
        </item>
    </item>
    <item name="name2">value2</item>
</items>
XML;

$xml = new SimpleXMLElement($xmlstr);

function xmlStrRev(SimpleXMLElement $xml): int
{
    $child_count = 0;
    foreach($xml as $item)
    {
        $child_count++;
        foreach ($item->attributes() as $key => $value)
            $item->attributes()->{$key} = strrev($value);
        if(xmlStrRev($item) == 0)
            $item[0] = strrev($item);
    }
    return $child_count;
}

xmlStrRev($xml);

echo "<pre>".htmlentities($xml->asXML())."</pre>";

?>
