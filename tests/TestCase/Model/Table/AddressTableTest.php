<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AddressTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AddressTable Test Case
 */
class AddressTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AddressTable
     */
    protected $Address;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Address'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Address') ? [] : ['className' => AddressTable::class];
        $this->Address = $this->getTableLocator()->get('Address', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Address);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AddressTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $address = $this->Address->newEntity([
            'province' => 'Pontevedra',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);


        $hasErrors=$address->hasErrors();
        $this->assertFalse($hasErrors);
    }

    //Provincia
    public function testValidationProvinceRequired(): void
    {
     
        $address = $this->Address->newEntity([
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El campo provincia es requerido.";
        $this->assertTrue($expected==$error["province"]["_required"]);
    }

    public function testValidationProvinceEmpty(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => '',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "La provincia no puede ser vac??a.";
        $this->assertTrue($expected==$error["province"]["_empty"]);
    }


    public function testValidationProvinceMin(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'a',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "La provincia debe tener m??nimo 3 caracteres.";
        $this->assertTrue($expected==$error["province"]["minLength"]);
    }

    public function testValidationProvinceMax(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "La provincia debe tener m??ximo 30 caracteres.";
        $this->assertTrue($expected==$error["province"]["maxLength"]);
    }

    public function testValidationProvinceAlfabetico(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Provinci$a',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "La provincia debe contener solo caracteres alfab??ticos y espacios.";
        $this->assertTrue($error["province"]["regex"]==$expected);
    }

    //C??digo Postal

    public function testValidationPostalCodeRequired(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Pontevedra',
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El campo c??digo postal es requerido.";
        $this->assertTrue($expected==$error["postal_code"]["_required"]);
    }
    public function testValidationPostalCodeRegex(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Pontevedra',
            'postal_code' => 350090,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "Introduce un c??digo postal con un formato correcto.";
        $this->assertTrue($error["postal_code"]["regex"]==$expected);
    }

    public function testValidationPostalCodeMin(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Province',
            'postal_code' => 354,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El c??digo postal debe tener m??nimo 5 caracteres.";
        $this->assertTrue($expected==$error["postal_code"]["minLength"]);
    }

    //Ciudad
    public function testValidationCityRequired(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Province',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El campo ciudad es requerido.";
        $this->assertTrue($expected==$error["city"]["_required"]);
    }

    public function testValidationCityEmpty(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Provincia',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => '',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);


        $error = $address->getErrors();
        $expected = "La ciudad no puede ser vac??o.";
        $this->assertTrue($expected==$error["city"]["_empty"]);
    }

    public function testValidationCityMin(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'province',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'a',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "La ciudad debe tener m??nimo 3 caracteres.";
        $this->assertTrue($expected==$error["city"]["minLength"]);
    }

    public function testValidationCityMax(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => '',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'Loremodolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit amet',
            'street' => 'Lorem ipsum'
        ]);

        $error = $address->getErrors();
        $expected = "La ciudad debe tener m??ximo 100 caracteres.";
        $this->assertTrue($expected==$error["city"]["maxLength"]);
    }

    public function testValidationCityAlfabetico(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Province',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'LoreLorem i%&$%??psum dolor sit ametmo',
            'street' => 'Lorem psum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "La ciudad debe contener solo caracteres alfab??ticos y espacios.";
        $this->assertTrue($error["city"]["regex"]==$expected);
    }

    //Pa??s
    public function testValidationCountryRequired(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Province',
            'postal_code' => 35004,
            'city' => 'ciudad',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El campo pa??s es requerido.";
        $this->assertTrue($expected==$error["country"]["_required"]);
    }

    public function testValidationCountryEmpty(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Provincia',
            'postal_code' => 35004,
            'country' => '',
            'city' => 'ciudad',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El pa??s no puede ser vac??o.";
        $this->assertTrue($expected==$error["country"]["_empty"]);
    }


    public function testValidationCountryMin(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'province',
            'postal_code' => 35004,
            'country' => 'Lo',
            'city' => 'ciudad',
            'street' => 'Lorem ipsum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El pa??s debe tener m??nimo 3 caracteres.";
        $this->assertTrue($expected==$error["country"]["minLength"]);
    }

    public function testValidationCountryMax(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Provincia',
            'postal_code' => 35004,
            'country' => 'LoreLoremodolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametm',
            'city' => 'ciudad',
            'street' => 'Lorem ipsum'
        ]);

        $error = $address->getErrors();
        $expected = "El pa??s debe tener m??ximo 100 caracteres.";
        $this->assertTrue($expected==$error["country"]["maxLength"]);
    }

    public function testValidationCountryAlfabetico(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Province',
            'postal_code' => 35004,
            'country' => 'Lor%&em',
            'city' => 'LoreLorem psum dolor sit ametmo',
            'street' => 'Lorem psum dolor sit amet'
        ]);

        $error = $address->getErrors();
        $expected = "El pa??s debe contener solo caracteres alfab??ticos y espacios.";
        $this->assertTrue($error["country"]["regex"]==$expected);
    }

    //Calle
    public function testValidationStreetRequired(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Province',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'ciudad',
        ]);

        $error = $address->getErrors();
        $expected = "El campo calle es requerido.";
        $this->assertTrue($expected==$error["street"]["_required"]);
    }

    public function testValidationStreetEmpty(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Provincia',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'ciudad',
            'street' => ''
        ]);

        $error = $address->getErrors();
        $expected = "La calle no puede ser vac??a.";
        $this->assertTrue($expected==$error["street"]["_empty"]);
    }
    public function testValidationStreetRegex(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'Pontevedra',
            'postal_code' => 35009,
            'country' => 'Lorem',
            'city' => 'Loremo',
            'street' => 'Lorem ipsum dolor sit$ amet'
        ]);

        $error = $address->getErrors();
        $expected = "La calle debe contener solo caracteres alfab??ticos, espacios y algunos s??mbolos [. , ?? ].";
        $this->assertTrue($error["street"]["regex"]==$expected);
    }

    public function testValidationStreetMin(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'province',
            'postal_code' => 35004,
            'country' => 'Lorem',
            'city' => 'ciudad',
            'street' => 'Lo'
        ]);

        $error = $address->getErrors();
        $expected = "La calle debe tener m??nimo 3 caracteres.";
        $this->assertTrue($expected==$error["street"]["minLength"]);
    }

    public function testValidationStreetMax(): void
    {
     
        $address = $this->Address->newEntity([
            'province' => 'provincia',
            'postal_code' => 35004,
            'country' => 'country',
            'city' => 'ciudad',
            'street' => 'Lorem iLoreLoremodolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametmpsum'
        ]);

        $error = $address->getErrors();
        $expected = "La calle debe tener m??ximo 100 caracteres.";
        $this->assertTrue($expected==$error["street"]["maxLength"]);
    }

}
