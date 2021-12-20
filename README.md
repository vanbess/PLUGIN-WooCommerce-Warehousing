# Silverback Dev Studios Warehousing for WooCommerce

Plugin which adds the ability to add and manage stock/shipping warehouses for internationally shipped products via custom post type 'warehouse'.

Warehouse post type features metabox with three data tabs:
- Warehouse Details tab: used for capturing warehouse location and contact details
- Warehouse Stock tab: used for manually adding product inventory and associated stock quantities to warehouse
- Countries & Shipping Times tab: used for defining and controlling the display of custom shipping messages below Add To Cart button on product single page based on user location for products which form part of inventory as defined in Warehouse Stock tab

## Compatibility

Compatible with all modern versions of WooCommerce. Supports simple and variable products only at this stage - additional product type support might be added later on. Compatible with Flatsome theme - compatibility with default WordPress themes to be determined/tested. 

Built on PHP 7xx+ with probable backwards compatibility with PHP 5xx+, WooCommerce 3xx+ and WordPress 4.5xx+. 

## To Do

- Possible implementation of API which communicates with warehouses in order to periodically update stock counts via chron job. This will likely be done once every 24 hours (default), but a custom time period will optionally be available once implemented
- Wider theme compatibility as and when needed/on request