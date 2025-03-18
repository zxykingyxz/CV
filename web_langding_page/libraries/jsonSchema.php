<?php

class jsonSchema
{

	private $d;

	private $func;

	public function __construct($d, $func)

	{

		$this->d = $d;

		$this->func = $func;
	}

	public function ItemList($data)
	{

		global $config, $https_config, $lang;

		if (count($data) > 5) {

			$dem = 5;
		} else {

			$dem = count($data);
		}

		$result = '';

		for ($i = 0; $i < $dem; $i++) {

			$result .= '{

		      "@type":"ListItem",

		      "position":' . ($i + 1) . ',

		      "url":"' . $https_config . $data[$i]["tenkhongdau"] . '"

		    },';
		}

		$result = substr($result, 0, -1);


		$html = '<script type="application/ld+json">

		{

		  	"@context":"http://schema.org",

		  	"@type":"ItemList",

		  	"itemListElement":[

		  		' . $result . '

			]

		}

		</script>';

		return self::compress($html);
	}

	public function BreadcrumbList($title, $data = array())
	{

		global $config, $row_setting, $https_config, $lang;

		$result = '';

		$k = 1;

		$result .= '{

			        "@type": "ListItem",

			        "position": ' . $k . ',

			        "name": "' . $title . '",

			        "item": "' . $https_config . '"

			      },';

		foreach ($data as $k1 => $v1) {

			$result .= '{

			        "@type": "ListItem",

			        "position": ' . ($k + 1) . ',

			        "name": "' . $v1["name"] . '",

			        "item": "' . $https_config . $v1["alias"] . '"

			      },';

			$k++;
		}

		$result = substr($result, 0, -1);

		$html = '<script type="application/ld+json">

			    {

			      "@context": "https://schema.org",

			      "@type": "BreadcrumbList",

			      "itemListElement": [

					' . $result . '

			      ]

			    }

		</script>';



		return self::compress($html);
	}

	public function Library()
	{

		global $config, $seo, $row_setting, $https_config, $lang, $func;

		$seoDB = $seo->getSeoDB(0, 'setting', 'capnhat', '');

		$map = explode(',', $row_setting['map_marker']);

		$html = '<script type="application/ld+json">{	

			"@context": "http://schema.org/",

		  	"@type": "Library",

			"url": "' . $https_config . '",

			"name": "' . $row_setting['name_' . $lang] . '",

			"image": "' . $https_config . _upload_hinhanh_l . $row_setting['bgtop'] . '",

			"priceRange": "FREE",

			"hasMap": "' . $row_setting['iframe_map'] . '",	

			"email": "mailto:' . $row_setting['email'] . '",

		  	"address": {

		    	"@type": "PostalAddress",

		    	"addressLocality": "' . $row_setting['district'] . '",

		    	"addressRegion": "' . $row_setting['city'] . '",

		    	"postalCode":"' . $row_setting['postalcode'] . '",

		    	"streetAddress": "' . $row_setting["address_$lang"] . '"

		  	},

		  	"description": "' . $seoDB['description_' . $lang] . '",

		  	"telephone": "+84 ' . $row_setting['hotline'] . '",

		  	"openingHoursSpecification": [
		        {
		          "@type": "OpeningHoursSpecification",
		          "dayOfWeek": [
		            "Monday",
		            "Tuesday",
		            "Wednesday",
		            "Thursday",
		            "Friday"
		          ],
		          "opens": "07:50",
		          "closes": "17:00"
		        },
		        {
		          "@type": "OpeningHoursSpecification",
		          "dayOfWeek": "Saturday",
		          "opens": "07:50",
		          "closes": "12:00"
		        },
		        {
		          "@type": "OpeningHoursSpecification",
		          "dayOfWeek": "Sunday",
		          "opens": "07:50",
		          "closes": "23:00"
		        }
		      ],

		  	"geo": {

		    	"@type": "GeoCoordinates",

		   		"latitude": "' . trim($map[0]) . '",

		    	"longitude": "' . trim($map[1]) . '"

		 		}, 			

		  	"sameAs" : [ 

			  	"' . $row_setting['facebook'] . '"

		  	]

		}

		</script>';

		return self::compress($html);
	}



	public function SearchAction()
	{

		global $config, $row_setting, $https_config, $func;

		$html = '<script type="application/ld+json">

		{

		  "@context": "http://schema.org",

		  "@type": "Website",

		  "url": "' . $https_config . '",

		  "potentialAction": [{

		    "@type": "SearchAction",

		    "target": "' . $https_config . 'tim-kiem?keywords={searchbox_target}",

		    "query-input": "required name=searchbox_target"

		  }]

		}

		</script>';

		return self::compress($html);
	}



	public function Person()
	{

		global $config, $row_setting, $lang, $https_config;

		$html = '<script type="application/ld+json">

		{

		  "@context": "http://schema.org",

		  "@type": "Person",

		  "name": "' . $row_setting["name_$lang"] . '",

		  "url": "' . $https_config . '",

		  "sameAs": [

		    "' . $row_setting['facebook'] . '"

		  ]

		}

		</script>';

		return self::compress($html);
	}



	public function NewsArticle($data, $seoDB)
	{

		global $config, $lang, $row_setting, $https_config;

		$html = '<script type="application/ld+json">

		{

		  "@context": "http://schema.org",

		  "@type": "NewsArticle",

		  "mainEntityOfPage": {

		    "@type": "WebPage",

		    "@id": "' . $this->func->getCurrentPageURL() . '"

		  },

		  "headline": "' . $data["ten_$lang"] . '",

		  "image": [
		  	"' . $https_config . _upload_baiviet_l . $data['photo'] . '"
		   ],

		  "datePublished": "' . date('c', $data['ngaytao']) . '",

		  "dateModified": "' . date('c', $data['ngaysua']) . '",

		  "author": {

		    "@type": "Person",

		    "name": "' . $row_setting["name_$lang"] . '"

		  },

		   "publisher": {

		    "@type": "Organization",

		    "name": "' . $row_setting["name_$lang"] . '",

		    "logo": {

		      "@type": "ImageObject",

		      "url": "' . $https_config . _upload_hinhanh_l . $row_setting['bgtop'] . '"

		    }

		  },

		  "description": "' . $seoDB['description_' . $lang] . '"

		}

		</script>';

		return self::compress($html);
	}



	public function VideoObject($data)
	{

		global $lang, $https_config;

		$result = '';

		foreach ($data as $k => $v) {

			if ($v['youtube'] != '') {

				$link_y = $v['youtube'];
			} else {

				$link_y = $https_config . _upload_video_l . $v['video'];
			}

			$result .= '{

	          "@type": "VideoObject",

	          "position": ' . ($k + 1) . ',

	          "name": "' . $v['ten_' . $lang] . '",

	          "url": "' . $https_config . $v["tenkhongdau"] . '",

	          "description": "' . $v['description'] . '",

	          "thumbnailUrl": [

	            "' . $https_config . _upload_hinhanh_l . $v['thumb'] . '",

	            "' . $https_config . _upload_hinhanh_l . $v['photo'] . '"

	          ],

	          "uploadDate": "' . date('c', $v['ngaytao']) . '",

	          "contentUrl": "' . $link_y . '"

	        },';
		}

		$result = substr($result, 0, -1);



		$html = '<script type="application/ld+json">

		{

	      "@context": "https://schema.org",

	      "@type": "ItemList",

	      "itemListElement": [

	        ' . $result . '

	      ]

	    }

		</script>';

		return self::compress($html);
	}



	public function Review($row_detail, $seoDB, $brand, $row_star = 1, $num_star = 5)
	{

		global $lang, $func, $row_setting, $config, $https_config;

		if (!$num_star) {

			$num_star = 5;
		}

		if (!$row_star) {

			$row_star = 1;
		}

		if ($row_detail['type'] == 'san-pham') {

			$ratingValue = '
			"brand": {

				"@type": "Thing",

				"name": "' . $brand . '"

			 },

			"sku": "' . $row_detail['masp'] . '",

			"mpn": "925872",

			"aggregateRating": {

			"@type": "AggregateRating",

			"ratingValue": "' . $num_star . '",

			"reviewCount": "' . $row_star . '"

			},
			"offers": {

				"@type": "Offer",
	
				"url": "' . $https_config . $row_detail["tenkhongdau_$lang"] . '",
	
				"priceCurrency": "VND",
	
				"price": "' . $row_detail['giaban'] . '",
	
				"priceValidUntil": "' . date('c', strtotime('2030-12-30')) . '",
	
				"itemCondition": "https://schema.org/UsedCondition",
	
				"availability": "https://schema.org/InStock",
	
				"seller": {
	
				  "@type": "Organization",
	
				  "name": "' . $row_setting["name_$lang"] . '"
	
				}
	
			},';
		}

		$html = '<script type="application/ld+json">

			{

			  "@context": "http://schema.org/",

			  "@type": "Product",

			  "image": "' . $https_config . _upload_baiviet_l . $row_detail['photo'] . '",

			  "name": "' . $row_detail["ten_$lang"] . '",

			  "description": "' . $seoDB['description_' . $lang] . '",

			  ' . $ratingValue . '

			  "review": {

					"@type": "Review",

					"reviewRating": {

					"@type": "Rating",

					"ratingValue": "' . $num_star . '"

					},

					"name": "' . $row_detail["ten_$lang"] . '",

					"author": {

					"@type": "Person",

					"name": "Administrator"

					},

					"datePublished": "' . date('c', $row_detail['ngaytao']) . '",

					"reviewBody": "' . $seoDB['description_' . $lang] . '",

					"publisher": {

					"@type": "Organization",

					"name": "' . $row_setting["name_$lang"] . '"

					}
				}

			}

			</script>';

		return self::compress($html);
	}



	public function Product($row_detail = null, $row_star = 1, $num_star = 5, $brand = null, $ratingValue = 4, $bestRating = 5)
	{

		global $lang, $func, $row_setting, $config, $https_config;

		$brand = !empty($brand) ? $brand : $row_setting["name_$lang"];

		if (!$num_star) {
			$num_star = 5;
		}

		if (!$row_star) {

			$row_star = 1;
		}

		$html = '<script type="application/ld+json">
			{
				"@context": "https://schema.org/", 
				"@type": "Product", 
				"name": "' . $row_detail["ten_$lang"] . '",
				"image": [

		        "' . $https_config . _upload_baiviet_l . $row_detail['thumb'] . '",

			    "' . $https_config . _upload_baiviet_l . $row_detail['photo'] . '"

		       ],
			  "description": "' . $row_detail['description'] . '",,
			  "manufacturer": "muaacquy",
			  "sku": "' . $row_detail['tenkhongdau'] . '",
			  "gtin13": "' . $row_detail['tenkhongdau'] . '",
			  "model": "' . $row_detail['tenkhongdau'] . '",
			  "brand":{ 
			      "@context":"http://schema.org",
			      "@type":"Organization",
			      "url":"' . $https_config . '",
			      "@id":"kg:/g/11jk8907cl",
			      "name":"Queen Crown",
			      "address":"' . $row_setting["name_$lang"] . '",
			      "telephone":"' . $row_setting["hotline"] . '",
			      "logo": {
			      "@type": "ImageObject",
			      "url": "' . $https_config . _upload_baiviet_l . $row_detail['photo'] . '"
			      }
			   },
			  "offers": {
			    "@type": "Offer",
			    "url": "' . $https_config . $row_detail["tenkhongdau"] . '",
			    "category":"' . $brand . '",
			    "priceCurrency": "VND",
			    "price": "' . $row_detail['giaban'] . '",
			    "priceValidUntil": "' . date('c', strtotime('2030-12-30')) . '",
			    "availability": "https://schema.org/InStock",
			    "itemCondition": "https://schema.org/NewCondition",
			    "warranty": "6 tháng",
			    "seller":{
					"@type": "Organization",
					"name": "' . $row_setting["name_$lang"] . '"
						}
			  },
			  "aggregateRating": {
			    "@type": "AggregateRating",
			    "ratingValue": "' . $num_star . '",
			    "ratingCount": "' . $row_detail["luotxem"] . '"
			  },
			  "additionalProperty":[
			 	{
		          "@type":"PropertyValue",
		          "name":"Mã sản phẩm",
		          "value":"' . $row_detail['masp'] . '",
		    	},
		        {
		          "@type":"PropertyValue",
		          "name":"Giá sản phẩm",
		          "value":"' . $this->_func->money($row_detail['giaban'], '') . ' VNĐ"
		        },
		        {
		          "@type":"PropertyValue",
		          "name":"Kiểu ắc quy",
		          "value":"Ắc quy nước"
		        },
				{
		         "@type":"PropertyValue",
		          "name":"Điện áp",
		          "value":"12V"
		        },
		        {
		          "@type":"PropertyValue",
		          "name":"Dung lượng",
		          "value":"200Ah"
		        },
		        {
		          "@type":"PropertyValue",
		          "name":"Kích thước",
		          "value":"520 x 278 x 268 mm (dài x rộng x cao)"
		        },
		        {
		          "@type":"PropertyValue",
		          "name":"Hãng sản xuất",
		          "value":"GS"
		        },
		        {
		         "@type":"PropertyValue",
		          "name":"Xuất xứ",
		          "value":"Việt Nam"
		        },
		        {
		          "@type":"PropertyValue",
		          "name":"Bảo hành",
		          "value":"6 tháng"
		        }
		    ],
			"hasMerchantReturnPolicy":{
			   "@type":"MerchantReturnPolicy", 
			   "merchantReturnLink":""' . $https_config . '"chinh-sach-doi-tra", 
			   "inStoreReturnsOffered ":"True", 
			   "merchantReturnDays": 7, 
			   "refundType": "FullRefund", 
			   "name": "Chính sách đổi trả và hoàn tiền"
			   },
			  "review": {
			    "@type": "Review",
			    "name": "Ngoc Thoai",
			    "reviewBody": "ắc quy này tốt đó, sẽ ủng hộ thêm",
			    "reviewRating": {
			      "@type": "Rating",
			      "ratingValue": "5"
			    },
			    "datePublished": "2021-05-28",
			    "author": {"@type": "Person", "name": "Ngoc Thoai"}
			  }
			}
			}
			</script>';

		return self::compress($html);
	}



	public function Organization()
	{

		global $config, $row_setting, $lang, $https_config;

		$html = '

		<script type="application/ld+json">

		{ "@context" : "http://schema.org",

		  "@type" : "Organization",

		  "name":"' . $row_setting["name_$lang"] . '",

		  "url" : "' . $this->func->getCurrentPageURL() . '",

		  "logo":"' . $https_config . _upload_hinhanh_l . $row_setting['bgtop'] . '",

		  "contactPoint" : [

		    {

		      "@type" : "ContactPoint",

		      "telephone" : "+84 ' . $row_setting['hotline'] . '",

		      "contactType" : "Customer Service",

		      "contactOption" : "Support",

		      "areaServed" : ["VN"],

		      "availableLanguage" : ["Viet Nam"]

		    } 

		    ] }

		</script>';

		return self::compress($html);
	}

	static public function compress($buffer)
	{

		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  '), '', $buffer);

		$buffer = str_replace('{ ', '{', $buffer);

		$buffer = str_replace(' }', '}', $buffer);

		$buffer = str_replace('; ', ';', $buffer);

		$buffer = str_replace(', ', ',', $buffer);

		$buffer = str_replace(' {', '{', $buffer);

		$buffer = str_replace('} ', '}', $buffer);

		$buffer = str_replace(': ', ':', $buffer);

		$buffer = str_replace(' ,', ',', $buffer);

		$buffer = str_replace(' ;', ';', $buffer);

		return $buffer;
	}
}
