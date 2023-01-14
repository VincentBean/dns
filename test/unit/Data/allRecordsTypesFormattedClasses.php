<?php

use MamaOmida\Dns\Records\Types\A;
use MamaOmida\Dns\Records\Types\AAAA;
use MamaOmida\Dns\Records\Types\CNAME;
use MamaOmida\Dns\Records\Types\DnsSec\CDNSKey;
use MamaOmida\Dns\Records\Types\DnsSec\CDS;
use MamaOmida\Dns\Records\Types\DnsSec\DNSKey;
use MamaOmida\Dns\Records\Types\DnsSec\DS;
use MamaOmida\Dns\Records\Types\DnsSec\NSEC;
use MamaOmida\Dns\Records\Types\DnsSec\NSEC3Param;
use MamaOmida\Dns\Records\Types\DnsSec\RRSig;
use MamaOmida\Dns\Records\Types\HInfo;
use MamaOmida\Dns\Records\Types\HTTPS;
use MamaOmida\Dns\Records\Types\MX;
use MamaOmida\Dns\Records\Types\NAPTR;
use MamaOmida\Dns\Records\Types\NS;
use MamaOmida\Dns\Records\Types\SOA;
use MamaOmida\Dns\Records\Types\SRV;
use MamaOmida\Dns\Records\Types\TXT;

return [
    [
        [
            'host'  => 'test.com',
            'class' => 'IN',
            'ttl'   => 0,
            'type'  => 'A',
            'ip'    => '20.81.111.85',
        ],
        A::class,
    ],
    [
        [
            'host'   => 'test.com',
            'class'  => 'IN',
            'ttl'    => 0,
            'type'   => 'NS',
            'target' => 'ns4-39.azure-dns.info',
        ],
        NS::class,
    ],
    [
        [
            'host'   => 'microsoft.com',
            'class'  => 'IN',
            'ttl'    => 0,
            'type'   => 'CNAME',
            'target' => 'microsoft.com',
        ],
        CNAME::class,
    ],
    [
        [
            'host'   => 'microsoft.com',
            'class'  => 'IN',
            'ttl'    => 0,
            'type'   => 'MX',
            'pri'    => 10,
            'target' => 'microsoft-com.mail.protection.outlook.com',
        ],
        MX::class,
    ],
    [
        [
            'host'        => 'microsoft.com',
            'ttl'         => '3600',
            'class'       => 'IN',
            'type'        => 'SOA',
            'mname'       => 'ns1-39.azure-dns.com',
            'rname'       => 'azuredns-hostmaster.microsoft.com',
            'serial'      => '1',
            'refresh'     => '3600',
            'retry'       => '300',
            'expire'      => '2419200',
            'minimum-ttl' => '300',
        ],
        SOA::class,
    ],
    [
        [
            'host'  => 'microsoft.com',
            'class' => 'IN',
            'ttl'   => 0,
            'type'  => 'TXT',
            'txt'   => 'google-site-verification=M--CVfn_YwsV-2FGbCp_HFaEj23BmT0cTF4l8hXgpvMt7sebee51jrj7vm932k531hipa8RPDXjBzBS9tu7Pbysu7qCACrwXPoDV8ZtLfthTnC4y9VJFLd84it5sQlEITgSLJ4KOIA8pBZxmyvPujuUvhOg==fg2t0gov9424p2tdcuo94goe9jd365mktkey=3uc1cf82cpv750lzk70v9bvf2hubspot-developer-verification=OTQ5NGIwYWEtODNmZi00YWE1LTkyNmQtNDhjMDMxY2JjNDAxd365mktkey=QDa792dLCZhvaAOOCe2Hz6WTzmTssOp1snABhxWibhMxgoogle-site-verification=pjPOauSPcrfXOZS9jnPPa5axowcHGCDAl1_86dCqFpkdocusign=d5a3737c-c23c-4bd0-9095-d2ff621f2840d365mktkey=SxDf1EZxLvMwx6eEZUxzjFFgHoapF8DvtWEUjwq7ZTwxd365mktkey=6358r1b7e13hox60tl1uagv14facebook-domain-verification=fwzwhbbzwmg5fzgotc2go51olc3566google-site-verification=GfDnTUdATPsK1230J0mXbfsYw-3A9BVMVaKSd4DcKgIgoogle-site-verification=uFg3wr5PWsK8lV029RoXXBBUW0_E6qf1WEWVHhetkOYv=spf1 include:_spf-a.microsoft.com include:_spf-b.microsoft.com include:_spf-c.microsoft.com include:_spf-ssg-a.msft.net include:spf-a.hotmail.com include:_spf1-meo.microsoft.com -alld365mktkey=j2qHWq9BHdaa3ZXZH8x64daJZxEWsFa0dxDeilxDoYYx',
        ],
        TXT::class,
    ],
    [
        [
            'host'  => 'microsoft.com',
            'class' => 'IN',
            'ttl'   => 0,
            'type'  => 'AAAA',
            'ipv6'  => '::ffff:1451:6f55',
        ],
        AAAA::class,
    ],
    [
        [
            'host'     => 'microsoft.com',
            'class'    => 'IN',
            'ttl'      => 0,
            'type'     => 'HINFO',
            'hardware' => 'HC-85',
            'os'       => 'Win 95'
        ],
        HInfo::class,
    ],
    [
        [
            'host'                 => 'microsoft.com',
            'class'                => 'IN',
            'ttl'                  => 0,
            'type'                 => 'RRSIG',
            'type-covered'         => 'A',
            'algorithm'            => 1,
            'labels-number'        => 2,
            'original-ttl'         => 3600,
            'signature-expiration' => 169254,
            'signature-creation'   => 169253,
            'key-tag'              => 49890,
            'signer-name'          => 'test.com',
            'signature'            => '==signature==',
        ],
        RRSig::class,
    ],
    [
        [
            'host'       => 'microsoft.com',
            'class'      => 'IN',
            'ttl'        => 0,
            'type'       => 'DNSKEY',
            'value'      => 'value',
            'flags'      => 255,
            'protocol'   => 3,
            'algorithm'  => 12,
            'public-key' => 'public-key=='
        ],
        DNSKey::class,
    ],
    [
        [
            'host'       => 'microsoft.com',
            'class'      => 'IN',
            'ttl'        => 0,
            'type'       => 'CDNSKEY',
            'value'      => 'value',
            'flags'      => 257,
            'protocol'   => 3,
            'algorithm'  => 12,
            'public-key' => 'sec-public-key=='
        ],
        CDNSKey::class,
    ],
    [
        [
            'host'             => 'microsoft.com',
            'class'            => 'IN',
            'ttl'              => 0,
            'type'             => 'DS',
            'key-tag'          => 2371,
            'algorithm'        => 13,
            'algorithm-digest' => 3,
            'digest'           => '1F987CC6583E92DF0890718C42'
        ],
        DS::class,
    ],
    [
        [
            'host'             => 'test.com',
            'class'            => 'IN',
            'ttl'              => 0,
            'type'             => 'CDS',
            'key-tag'          => 2371,
            'algorithm'        => 12,
            'algorithm-digest' => 2,
            'digest'           => '1F987CC6583E92DF0890718C42'
        ],
        CDS::class,
    ],
    [
        [
            'host'                    => 'test.com',
            'class'                   => 'IN',
            'ttl'                     => 0,
            'type'                    => 'NSEC',
            'next-authoritative-name' => 'auth.test.com',
            'types'                   => 'A AAAA NS SOA TXT',
        ],
        NSEC::class,
    ],
    [
        [
            'host'       => 'microsoft.com',
            'class'      => 'IN',
            'ttl'        => 0,
            'type'       => 'NSEC3PARAM',
            'value'      => 'value',
            'algorithm'  => 12,
            'flags'      => 255,
            'iterations' => 3,
            'salt'       => 'salt==',
        ],
        NSEC3Param::class,
    ],
    [
        [
            'host'   => 'test.com',
            'class'  => 'IN',
            'ttl'    => 0,
            'type'   => 'SRV',
            'pri'    => 1,
            'port'   => 10,
            'target' => '192.168.0.1',
            'weight' => 9,
        ],
        SRV::class,
    ],
    [
        [
            'host'            => 'test.com',
            'class'           => 'IN',
            'ttl'             => 0,
            'type'            => 'TYPE65',
            'separator'       => '\#',
            'original-length' => 27,
            'data'            => '1000C0268330568332D3239AA',
        ],
        HTTPS::class,
    ],
    [
        [
            'host'        => 'test.com',
            'class'       => 'IN',
            'ttl'         => 0,
            'type'        => 'NAPTR',
            'order'       => 100,
            'pref'        => 10,
            'flag'        => 'U',
            'services'    => 'SIP+D2U',
            'regex'       => '!^.*$!sip:service@example.com!',
            'replacement' => '.',
        ],
        NAPTR::class,
    ],
];
