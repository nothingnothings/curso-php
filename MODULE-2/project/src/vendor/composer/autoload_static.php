<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7422faf8f33d1f1cdfca8767e0ffc0f4
{
    public static $files = array (
        '23c18046f52bef3eea034657bafda50f' => __DIR__ . '/..' . '/symfony/polyfill-php81/bootstrap.php',
        'e39a8b23c42d4e1452234d762b03835a' => __DIR__ . '/..' . '/ramsey/uuid/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php81\\' => 23,
        ),
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
            'Ramsey\\Collection\\' => 18,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
        ),
        'A' => 
        array (
            'App\\' => 4,
            'App9\\' => 5,
            'App8\\' => 5,
            'App7\\' => 5,
            'App6\\' => 5,
            'App5\\' => 5,
            'App4\\' => 5,
            'App3\\' => 5,
            'App2\\' => 5,
            'App19\\Classes\\' => 14,
            'App19\\' => 6,
            'App18\\' => 6,
            'App17\\' => 6,
            'App16\\' => 6,
            'App15\\' => 6,
            'App14\\' => 6,
            'App13\\' => 6,
            'App12\\' => 6,
            'App11\\' => 6,
            'App10\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php81\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php81',
        ),
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Ramsey\\Collection\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/collection/src',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/coding-autoloading-and-composer-example/app',
        ),
        'App9\\' => 
        array (
            0 => __DIR__ . '/../..' . '/traits-example-3',
        ),
        'App8\\' => 
        array (
            0 => __DIR__ . '/../..' . '/traits-example-2',
        ),
        'App7\\' => 
        array (
            0 => __DIR__ . '/../..' . '/traits-example',
        ),
        'App6\\' => 
        array (
            0 => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks',
        ),
        'App5\\' => 
        array (
            0 => __DIR__ . '/../..' . '/late-static-binding-example',
        ),
        'App4\\' => 
        array (
            0 => __DIR__ . '/../..' . '/magic-methods-example',
        ),
        'App3\\' => 
        array (
            0 => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example',
        ),
        'App2\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inheritance-example',
        ),
        'App19\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'App19\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'App18\\' => 
        array (
            0 => __DIR__ . '/../..' . '/superglobals-basic-routing-using-the-server-info',
        ),
        'App17\\' => 
        array (
            0 => __DIR__ . '/../..' . '/php-iterables-and-iterable-type-iterate-over-objects',
        ),
        'App16\\' => 
        array (
            0 => __DIR__ . '/../..' . '/OOP-error-handling-in-php-exceptions-and-try-catch-blocks',
        ),
        'App15\\' => 
        array (
            0 => __DIR__ . '/../..' . '/serialize-objects-and-serialize-magic-methods-3',
        ),
        'App14\\' => 
        array (
            0 => __DIR__ . '/../..' . '/serialize-objects-and-serialize-magic-methods-2',
        ),
        'App13\\' => 
        array (
            0 => __DIR__ . '/../..' . '/serialize-objects-and-serialize-magic-methods',
        ),
        'App12\\' => 
        array (
            0 => __DIR__ . '/../..' . '/object-cloning-and-clone-magic-method-2',
        ),
        'App11\\' => 
        array (
            0 => __DIR__ . '/../..' . '/object-cloning-and-clone-magic-method',
        ),
        'App10\\' => 
        array (
            0 => __DIR__ . '/../..' . '/traits-example-4',
        ),
    );

    public static $classMap = array (
        'App11\\Invoice' => __DIR__ . '/../..' . '/object-cloning-and-clone-magic-method/Invoice.php',
        'App13\\Invoice' => __DIR__ . '/../..' . '/serialize-objects-and-serialize-magic-methods/Invoice.php',
        'App16\\Customer' => __DIR__ . '/../..' . '/OOP-error-handling-in-php-exceptions-and-try-catch-blocks/Customer.php',
        'App16\\Invoice' => __DIR__ . '/../..' . '/OOP-error-handling-in-php-exceptions-and-try-catch-blocks/Invoice.php',
        'App16\\InvoiceException' => __DIR__ . '/../..' . '/OOP-error-handling-in-php-exceptions-and-try-catch-blocks/InvoiceException.php',
        'App16\\MissingBillingInfoException' => __DIR__ . '/../..' . '/OOP-error-handling-in-php-exceptions-and-try-catch-blocks/MissingBillingInfoException.php',
        'App17\\Collection' => __DIR__ . '/../..' . '/php-iterables-and-iterable-type-iterate-over-objects/Collection.php',
        'App17\\Invoice' => __DIR__ . '/../..' . '/php-iterables-and-iterable-type-iterate-over-objects/Invoice.php',
        'App17\\InvoiceCollection' => __DIR__ . '/../..' . '/php-iterables-and-iterable-type-iterate-over-objects/InvoiceCollection.php',
        'App18\\Router' => __DIR__ . '/../..' . '/superglobals-basic-routing-using-the-server-info/Router.php',
        'App19\\Classes\\Home' => __DIR__ . '/../..' . '/app/Home.php',
        'App19\\Classes\\Invoices' => __DIR__ . '/../..' . '/app/Invoices.php',
        'App19\\Router' => __DIR__ . '/../..' . '/app/Router.php',
        'App2\\FancyOven' => __DIR__ . '/../..' . '/inheritance-example/FancyOven.php',
        'App2\\Toaster' => __DIR__ . '/../..' . '/inheritance-example/Toaster.php',
        'App2\\ToasterPro' => __DIR__ . '/../..' . '/inheritance-example/ToasterPro.php',
        'App2\\ToasterProWithConstructor' => __DIR__ . '/../..' . '/inheritance-example/ToasterProWithConstructor.php',
        'App2\\ToasterWithConstructor' => __DIR__ . '/../..' . '/inheritance-example/ToasterWithConstructor.php',
        'App3\\AnotherInterface' => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example/AnotherInterface.php',
        'App3\\CollectionAgency' => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example/CollectionAgency.php',
        'App3\\DebtCollectionService' => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example/DebtCollectionService.php',
        'App3\\DebtCollector' => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example/DebtCollector.php',
        'App3\\RockyTheDebtCollector' => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example/RockyTheDebtCollector.php',
        'App3\\SomeOtherInterface' => __DIR__ . '/../..' . '/interfaces-and-polymorphism-example/SomeOtherInterface.php',
        'App5\\ClassA' => __DIR__ . '/../..' . '/late-static-binding-example/ClassA.php',
        'App5\\ClassB' => __DIR__ . '/../..' . '/late-static-binding-example/ClassB.php',
        'App6\\AllInOneCoffeeMaker' => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks/AllInOneCoffeeMaker.php',
        'App6\\CappuccinoMaker' => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks/CappuccinoMaker.php',
        'App6\\CappuccinoTrait' => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks/CappuccinoTrait.php',
        'App6\\CoffeeMaker' => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks/CoffeeMaker.php',
        'App6\\LatteMaker' => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks/LatteMaker.php',
        'App6\\LatteTrait' => __DIR__ . '/../..' . '/traits-how-they-work-and-drawbacks/LatteTrait.php',
        'App\\PaymentGateway\\Paddle\\Transaction' => __DIR__ . '/../..' . '/coding-autoloading-and-composer-example/app/PaymentGateway/Paddle/Transaction.php',
        'App\\PaymentGateway\\Stripe\\Transaction' => __DIR__ . '/../..' . '/coding-autoloading-and-composer-example/app/PaymentGateway/Stripe/Transaction.php',
        'Brick\\Math\\BigDecimal' => __DIR__ . '/..' . '/brick/math/src/BigDecimal.php',
        'Brick\\Math\\BigInteger' => __DIR__ . '/..' . '/brick/math/src/BigInteger.php',
        'Brick\\Math\\BigNumber' => __DIR__ . '/..' . '/brick/math/src/BigNumber.php',
        'Brick\\Math\\BigRational' => __DIR__ . '/..' . '/brick/math/src/BigRational.php',
        'Brick\\Math\\Exception\\DivisionByZeroException' => __DIR__ . '/..' . '/brick/math/src/Exception/DivisionByZeroException.php',
        'Brick\\Math\\Exception\\IntegerOverflowException' => __DIR__ . '/..' . '/brick/math/src/Exception/IntegerOverflowException.php',
        'Brick\\Math\\Exception\\MathException' => __DIR__ . '/..' . '/brick/math/src/Exception/MathException.php',
        'Brick\\Math\\Exception\\NegativeNumberException' => __DIR__ . '/..' . '/brick/math/src/Exception/NegativeNumberException.php',
        'Brick\\Math\\Exception\\NumberFormatException' => __DIR__ . '/..' . '/brick/math/src/Exception/NumberFormatException.php',
        'Brick\\Math\\Exception\\RoundingNecessaryException' => __DIR__ . '/..' . '/brick/math/src/Exception/RoundingNecessaryException.php',
        'Brick\\Math\\Internal\\Calculator' => __DIR__ . '/..' . '/brick/math/src/Internal/Calculator.php',
        'Brick\\Math\\Internal\\Calculator\\BcMathCalculator' => __DIR__ . '/..' . '/brick/math/src/Internal/Calculator/BcMathCalculator.php',
        'Brick\\Math\\Internal\\Calculator\\GmpCalculator' => __DIR__ . '/..' . '/brick/math/src/Internal/Calculator/GmpCalculator.php',
        'Brick\\Math\\Internal\\Calculator\\NativeCalculator' => __DIR__ . '/..' . '/brick/math/src/Internal/Calculator/NativeCalculator.php',
        'Brick\\Math\\RoundingMode' => __DIR__ . '/..' . '/brick/math/src/RoundingMode.php',
        'CURLStringFile' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/CURLStringFile.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Ramsey\\Collection\\AbstractArray' => __DIR__ . '/..' . '/ramsey/collection/src/AbstractArray.php',
        'Ramsey\\Collection\\AbstractCollection' => __DIR__ . '/..' . '/ramsey/collection/src/AbstractCollection.php',
        'Ramsey\\Collection\\AbstractSet' => __DIR__ . '/..' . '/ramsey/collection/src/AbstractSet.php',
        'Ramsey\\Collection\\ArrayInterface' => __DIR__ . '/..' . '/ramsey/collection/src/ArrayInterface.php',
        'Ramsey\\Collection\\Collection' => __DIR__ . '/..' . '/ramsey/collection/src/Collection.php',
        'Ramsey\\Collection\\CollectionInterface' => __DIR__ . '/..' . '/ramsey/collection/src/CollectionInterface.php',
        'Ramsey\\Collection\\DoubleEndedQueue' => __DIR__ . '/..' . '/ramsey/collection/src/DoubleEndedQueue.php',
        'Ramsey\\Collection\\DoubleEndedQueueInterface' => __DIR__ . '/..' . '/ramsey/collection/src/DoubleEndedQueueInterface.php',
        'Ramsey\\Collection\\Exception\\CollectionMismatchException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/CollectionMismatchException.php',
        'Ramsey\\Collection\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/InvalidArgumentException.php',
        'Ramsey\\Collection\\Exception\\InvalidSortOrderException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/InvalidSortOrderException.php',
        'Ramsey\\Collection\\Exception\\NoSuchElementException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/NoSuchElementException.php',
        'Ramsey\\Collection\\Exception\\OutOfBoundsException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/OutOfBoundsException.php',
        'Ramsey\\Collection\\Exception\\UnsupportedOperationException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/UnsupportedOperationException.php',
        'Ramsey\\Collection\\Exception\\ValueExtractionException' => __DIR__ . '/..' . '/ramsey/collection/src/Exception/ValueExtractionException.php',
        'Ramsey\\Collection\\GenericArray' => __DIR__ . '/..' . '/ramsey/collection/src/GenericArray.php',
        'Ramsey\\Collection\\Map\\AbstractMap' => __DIR__ . '/..' . '/ramsey/collection/src/Map/AbstractMap.php',
        'Ramsey\\Collection\\Map\\AbstractTypedMap' => __DIR__ . '/..' . '/ramsey/collection/src/Map/AbstractTypedMap.php',
        'Ramsey\\Collection\\Map\\AssociativeArrayMap' => __DIR__ . '/..' . '/ramsey/collection/src/Map/AssociativeArrayMap.php',
        'Ramsey\\Collection\\Map\\MapInterface' => __DIR__ . '/..' . '/ramsey/collection/src/Map/MapInterface.php',
        'Ramsey\\Collection\\Map\\NamedParameterMap' => __DIR__ . '/..' . '/ramsey/collection/src/Map/NamedParameterMap.php',
        'Ramsey\\Collection\\Map\\TypedMap' => __DIR__ . '/..' . '/ramsey/collection/src/Map/TypedMap.php',
        'Ramsey\\Collection\\Map\\TypedMapInterface' => __DIR__ . '/..' . '/ramsey/collection/src/Map/TypedMapInterface.php',
        'Ramsey\\Collection\\Queue' => __DIR__ . '/..' . '/ramsey/collection/src/Queue.php',
        'Ramsey\\Collection\\QueueInterface' => __DIR__ . '/..' . '/ramsey/collection/src/QueueInterface.php',
        'Ramsey\\Collection\\Set' => __DIR__ . '/..' . '/ramsey/collection/src/Set.php',
        'Ramsey\\Collection\\Tool\\TypeTrait' => __DIR__ . '/..' . '/ramsey/collection/src/Tool/TypeTrait.php',
        'Ramsey\\Collection\\Tool\\ValueExtractorTrait' => __DIR__ . '/..' . '/ramsey/collection/src/Tool/ValueExtractorTrait.php',
        'Ramsey\\Collection\\Tool\\ValueToStringTrait' => __DIR__ . '/..' . '/ramsey/collection/src/Tool/ValueToStringTrait.php',
        'Ramsey\\Uuid\\BinaryUtils' => __DIR__ . '/..' . '/ramsey/uuid/src/BinaryUtils.php',
        'Ramsey\\Uuid\\Builder\\BuilderCollection' => __DIR__ . '/..' . '/ramsey/uuid/src/Builder/BuilderCollection.php',
        'Ramsey\\Uuid\\Builder\\DefaultUuidBuilder' => __DIR__ . '/..' . '/ramsey/uuid/src/Builder/DefaultUuidBuilder.php',
        'Ramsey\\Uuid\\Builder\\DegradedUuidBuilder' => __DIR__ . '/..' . '/ramsey/uuid/src/Builder/DegradedUuidBuilder.php',
        'Ramsey\\Uuid\\Builder\\FallbackBuilder' => __DIR__ . '/..' . '/ramsey/uuid/src/Builder/FallbackBuilder.php',
        'Ramsey\\Uuid\\Builder\\UuidBuilderInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Builder/UuidBuilderInterface.php',
        'Ramsey\\Uuid\\Codec\\CodecInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Codec/CodecInterface.php',
        'Ramsey\\Uuid\\Codec\\GuidStringCodec' => __DIR__ . '/..' . '/ramsey/uuid/src/Codec/GuidStringCodec.php',
        'Ramsey\\Uuid\\Codec\\OrderedTimeCodec' => __DIR__ . '/..' . '/ramsey/uuid/src/Codec/OrderedTimeCodec.php',
        'Ramsey\\Uuid\\Codec\\StringCodec' => __DIR__ . '/..' . '/ramsey/uuid/src/Codec/StringCodec.php',
        'Ramsey\\Uuid\\Codec\\TimestampFirstCombCodec' => __DIR__ . '/..' . '/ramsey/uuid/src/Codec/TimestampFirstCombCodec.php',
        'Ramsey\\Uuid\\Codec\\TimestampLastCombCodec' => __DIR__ . '/..' . '/ramsey/uuid/src/Codec/TimestampLastCombCodec.php',
        'Ramsey\\Uuid\\Converter\\NumberConverterInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/NumberConverterInterface.php',
        'Ramsey\\Uuid\\Converter\\Number\\BigNumberConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Number/BigNumberConverter.php',
        'Ramsey\\Uuid\\Converter\\Number\\DegradedNumberConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Number/DegradedNumberConverter.php',
        'Ramsey\\Uuid\\Converter\\Number\\GenericNumberConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Number/GenericNumberConverter.php',
        'Ramsey\\Uuid\\Converter\\TimeConverterInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/TimeConverterInterface.php',
        'Ramsey\\Uuid\\Converter\\Time\\BigNumberTimeConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Time/BigNumberTimeConverter.php',
        'Ramsey\\Uuid\\Converter\\Time\\DegradedTimeConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Time/DegradedTimeConverter.php',
        'Ramsey\\Uuid\\Converter\\Time\\GenericTimeConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Time/GenericTimeConverter.php',
        'Ramsey\\Uuid\\Converter\\Time\\PhpTimeConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Time/PhpTimeConverter.php',
        'Ramsey\\Uuid\\Converter\\Time\\UnixTimeConverter' => __DIR__ . '/..' . '/ramsey/uuid/src/Converter/Time/UnixTimeConverter.php',
        'Ramsey\\Uuid\\DegradedUuid' => __DIR__ . '/..' . '/ramsey/uuid/src/DegradedUuid.php',
        'Ramsey\\Uuid\\DeprecatedUuidInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/DeprecatedUuidInterface.php',
        'Ramsey\\Uuid\\DeprecatedUuidMethodsTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/DeprecatedUuidMethodsTrait.php',
        'Ramsey\\Uuid\\Exception\\BuilderNotFoundException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/BuilderNotFoundException.php',
        'Ramsey\\Uuid\\Exception\\DateTimeException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/DateTimeException.php',
        'Ramsey\\Uuid\\Exception\\DceSecurityException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/DceSecurityException.php',
        'Ramsey\\Uuid\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/InvalidArgumentException.php',
        'Ramsey\\Uuid\\Exception\\InvalidBytesException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/InvalidBytesException.php',
        'Ramsey\\Uuid\\Exception\\InvalidUuidStringException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/InvalidUuidStringException.php',
        'Ramsey\\Uuid\\Exception\\NameException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/NameException.php',
        'Ramsey\\Uuid\\Exception\\NodeException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/NodeException.php',
        'Ramsey\\Uuid\\Exception\\RandomSourceException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/RandomSourceException.php',
        'Ramsey\\Uuid\\Exception\\TimeSourceException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/TimeSourceException.php',
        'Ramsey\\Uuid\\Exception\\UnableToBuildUuidException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/UnableToBuildUuidException.php',
        'Ramsey\\Uuid\\Exception\\UnsupportedOperationException' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/UnsupportedOperationException.php',
        'Ramsey\\Uuid\\Exception\\UuidExceptionInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Exception/UuidExceptionInterface.php',
        'Ramsey\\Uuid\\FeatureSet' => __DIR__ . '/..' . '/ramsey/uuid/src/FeatureSet.php',
        'Ramsey\\Uuid\\Fields\\FieldsInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Fields/FieldsInterface.php',
        'Ramsey\\Uuid\\Fields\\SerializableFieldsTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/Fields/SerializableFieldsTrait.php',
        'Ramsey\\Uuid\\Generator\\CombGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/CombGenerator.php',
        'Ramsey\\Uuid\\Generator\\DceSecurityGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/DceSecurityGenerator.php',
        'Ramsey\\Uuid\\Generator\\DceSecurityGeneratorInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/DceSecurityGeneratorInterface.php',
        'Ramsey\\Uuid\\Generator\\DefaultNameGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/DefaultNameGenerator.php',
        'Ramsey\\Uuid\\Generator\\DefaultTimeGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/DefaultTimeGenerator.php',
        'Ramsey\\Uuid\\Generator\\NameGeneratorFactory' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/NameGeneratorFactory.php',
        'Ramsey\\Uuid\\Generator\\NameGeneratorInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/NameGeneratorInterface.php',
        'Ramsey\\Uuid\\Generator\\PeclUuidNameGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/PeclUuidNameGenerator.php',
        'Ramsey\\Uuid\\Generator\\PeclUuidRandomGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/PeclUuidRandomGenerator.php',
        'Ramsey\\Uuid\\Generator\\PeclUuidTimeGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/PeclUuidTimeGenerator.php',
        'Ramsey\\Uuid\\Generator\\RandomBytesGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/RandomBytesGenerator.php',
        'Ramsey\\Uuid\\Generator\\RandomGeneratorFactory' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/RandomGeneratorFactory.php',
        'Ramsey\\Uuid\\Generator\\RandomGeneratorInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/RandomGeneratorInterface.php',
        'Ramsey\\Uuid\\Generator\\RandomLibAdapter' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/RandomLibAdapter.php',
        'Ramsey\\Uuid\\Generator\\TimeGeneratorFactory' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/TimeGeneratorFactory.php',
        'Ramsey\\Uuid\\Generator\\TimeGeneratorInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/TimeGeneratorInterface.php',
        'Ramsey\\Uuid\\Generator\\UnixTimeGenerator' => __DIR__ . '/..' . '/ramsey/uuid/src/Generator/UnixTimeGenerator.php',
        'Ramsey\\Uuid\\Guid\\Fields' => __DIR__ . '/..' . '/ramsey/uuid/src/Guid/Fields.php',
        'Ramsey\\Uuid\\Guid\\Guid' => __DIR__ . '/..' . '/ramsey/uuid/src/Guid/Guid.php',
        'Ramsey\\Uuid\\Guid\\GuidBuilder' => __DIR__ . '/..' . '/ramsey/uuid/src/Guid/GuidBuilder.php',
        'Ramsey\\Uuid\\Lazy\\LazyUuidFromString' => __DIR__ . '/..' . '/ramsey/uuid/src/Lazy/LazyUuidFromString.php',
        'Ramsey\\Uuid\\Math\\BrickMathCalculator' => __DIR__ . '/..' . '/ramsey/uuid/src/Math/BrickMathCalculator.php',
        'Ramsey\\Uuid\\Math\\CalculatorInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Math/CalculatorInterface.php',
        'Ramsey\\Uuid\\Math\\RoundingMode' => __DIR__ . '/..' . '/ramsey/uuid/src/Math/RoundingMode.php',
        'Ramsey\\Uuid\\Nonstandard\\Fields' => __DIR__ . '/..' . '/ramsey/uuid/src/Nonstandard/Fields.php',
        'Ramsey\\Uuid\\Nonstandard\\Uuid' => __DIR__ . '/..' . '/ramsey/uuid/src/Nonstandard/Uuid.php',
        'Ramsey\\Uuid\\Nonstandard\\UuidBuilder' => __DIR__ . '/..' . '/ramsey/uuid/src/Nonstandard/UuidBuilder.php',
        'Ramsey\\Uuid\\Nonstandard\\UuidV6' => __DIR__ . '/..' . '/ramsey/uuid/src/Nonstandard/UuidV6.php',
        'Ramsey\\Uuid\\Provider\\DceSecurityProviderInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/DceSecurityProviderInterface.php',
        'Ramsey\\Uuid\\Provider\\Dce\\SystemDceSecurityProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Dce/SystemDceSecurityProvider.php',
        'Ramsey\\Uuid\\Provider\\NodeProviderInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/NodeProviderInterface.php',
        'Ramsey\\Uuid\\Provider\\Node\\FallbackNodeProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Node/FallbackNodeProvider.php',
        'Ramsey\\Uuid\\Provider\\Node\\NodeProviderCollection' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Node/NodeProviderCollection.php',
        'Ramsey\\Uuid\\Provider\\Node\\RandomNodeProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Node/RandomNodeProvider.php',
        'Ramsey\\Uuid\\Provider\\Node\\StaticNodeProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Node/StaticNodeProvider.php',
        'Ramsey\\Uuid\\Provider\\Node\\SystemNodeProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Node/SystemNodeProvider.php',
        'Ramsey\\Uuid\\Provider\\TimeProviderInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/TimeProviderInterface.php',
        'Ramsey\\Uuid\\Provider\\Time\\FixedTimeProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Time/FixedTimeProvider.php',
        'Ramsey\\Uuid\\Provider\\Time\\SystemTimeProvider' => __DIR__ . '/..' . '/ramsey/uuid/src/Provider/Time/SystemTimeProvider.php',
        'Ramsey\\Uuid\\Rfc4122\\Fields' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/Fields.php',
        'Ramsey\\Uuid\\Rfc4122\\FieldsInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/FieldsInterface.php',
        'Ramsey\\Uuid\\Rfc4122\\MaxTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/MaxTrait.php',
        'Ramsey\\Uuid\\Rfc4122\\MaxUuid' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/MaxUuid.php',
        'Ramsey\\Uuid\\Rfc4122\\NilTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/NilTrait.php',
        'Ramsey\\Uuid\\Rfc4122\\NilUuid' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/NilUuid.php',
        'Ramsey\\Uuid\\Rfc4122\\TimeTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/TimeTrait.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidBuilder' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidBuilder.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidInterface.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV1' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV1.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV2' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV2.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV3' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV3.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV4' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV4.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV5' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV5.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV6' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV6.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV7' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV7.php',
        'Ramsey\\Uuid\\Rfc4122\\UuidV8' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/UuidV8.php',
        'Ramsey\\Uuid\\Rfc4122\\Validator' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/Validator.php',
        'Ramsey\\Uuid\\Rfc4122\\VariantTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/VariantTrait.php',
        'Ramsey\\Uuid\\Rfc4122\\VersionTrait' => __DIR__ . '/..' . '/ramsey/uuid/src/Rfc4122/VersionTrait.php',
        'Ramsey\\Uuid\\Type\\Decimal' => __DIR__ . '/..' . '/ramsey/uuid/src/Type/Decimal.php',
        'Ramsey\\Uuid\\Type\\Hexadecimal' => __DIR__ . '/..' . '/ramsey/uuid/src/Type/Hexadecimal.php',
        'Ramsey\\Uuid\\Type\\Integer' => __DIR__ . '/..' . '/ramsey/uuid/src/Type/Integer.php',
        'Ramsey\\Uuid\\Type\\NumberInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Type/NumberInterface.php',
        'Ramsey\\Uuid\\Type\\Time' => __DIR__ . '/..' . '/ramsey/uuid/src/Type/Time.php',
        'Ramsey\\Uuid\\Type\\TypeInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Type/TypeInterface.php',
        'Ramsey\\Uuid\\Uuid' => __DIR__ . '/..' . '/ramsey/uuid/src/Uuid.php',
        'Ramsey\\Uuid\\UuidFactory' => __DIR__ . '/..' . '/ramsey/uuid/src/UuidFactory.php',
        'Ramsey\\Uuid\\UuidFactoryInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/UuidFactoryInterface.php',
        'Ramsey\\Uuid\\UuidInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/UuidInterface.php',
        'Ramsey\\Uuid\\Validator\\GenericValidator' => __DIR__ . '/..' . '/ramsey/uuid/src/Validator/GenericValidator.php',
        'Ramsey\\Uuid\\Validator\\ValidatorInterface' => __DIR__ . '/..' . '/ramsey/uuid/src/Validator/ValidatorInterface.php',
        'ReturnTypeWillChange' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/ReturnTypeWillChange.php',
        'Symfony\\Polyfill\\Php81\\Php81' => __DIR__ . '/..' . '/symfony/polyfill-php81/Php81.php',
        'app3\\Invoice' => __DIR__ . '/../..' . '/magic-methods-example/Invoice.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7422faf8f33d1f1cdfca8767e0ffc0f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7422faf8f33d1f1cdfca8767e0ffc0f4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7422faf8f33d1f1cdfca8767e0ffc0f4::$classMap;

        }, null, ClassLoader::class);
    }
}
