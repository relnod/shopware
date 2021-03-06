<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace   Shopware\Models\Customer;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @deprecated Since 5.2 removed in 5.4 use \Shopware\Models\Customer\Address
 * Shopware customer shipping model represents a single shipping address of a customer.
 *
 * The Shopware customer shipping model represents a row of the s_user_shippingaddress table.
 * The shipping model data set from the Shopware\Models\Customer\Repository.
 * One shipping address has the follows associations:
 * <code>
 *   - Customer =>  Shopware\Models\Customer\Customer [1:1] [s_user]
 * </code>
 * The s_user_shippingaddress table has the follows indices:
 * <code>
 *   - PRIMARY KEY (`id`)
 *   - UNIQUE KEY `userID` (`userID`)
 * </code>
 *
 * @ORM\Entity
 * @ORM\Table(name="s_user_shippingaddress")
 */
class Shipping extends ModelEntity
{
    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    protected $title;

    /**
     * Contains the id of the state. Used for shipping - state association.
     *
     * @var int
     * @ORM\Column(name="stateID", type="integer", nullable=true)
     */
    protected $stateId = null;

    /**
     * Contains the additional address line data
     *
     * @var string
     * @ORM\Column(name="additional_address_line1", type="string", length=255, nullable=true)
     */
    protected $additionalAddressLine1 = null;

    /**
     * Contains the additional address line data 2
     *
     * @var string
     * @ORM\Column(name="additional_address_line2", type="string", length=255, nullable=true)
     */
    protected $additionalAddressLine2 = null;

    /**
     * OWNING SIDE
     * The customer property is the owning side of the association between customer and shipping.
     * The association is joined over the shipping userID and the customer id
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Customer\Customer", inversedBy="shipping")
     * @ORM\JoinColumn(name="userID", referencedColumnName="id")
     *
     * @var \Shopware\Models\Customer\Customer
     */
    protected $customer;

    /**
     * INVERSE SIDE
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\CustomerShipping", mappedBy="customerShipping", orphanRemoval=true, cascade={"persist"})
     *
     * @var \Shopware\Models\Attribute\CustomerShipping
     */
    protected $attribute;
    /**
     * The id property is an identifier property which means
     * doctrine associations can be defined over this field
     *
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * If of the associated customer. Used as foreign key for the
     * customer - shipping association.
     *
     * @var int
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $customerId;

    /**
     * Contains the name of the shipping address company
     *
     * @var string
     * @ORM\Column(name="company", type="string", length=255, nullable=false)
     */
    private $company = '';

    /**
     * Contains the department name of the shipping address company
     *
     * @var string
     * @ORM\Column(name="department", type="string", length=35, nullable=false)
     */
    private $department = '';

    /**
     * Contains the customer salutation (Mr, Ms, Company)
     *
     * @var string
     * @ORM\Column(name="salutation", type="string", length=30, nullable=false)
     */
    private $salutation = '';

    /**
     * Contains the first name of the shipping address
     *
     * @var string
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
    private $firstName = '';

    /**
     * Contains the last name of the shipping address
     *
     * @var string
     * @ORM\Column(name="lastname", type="string", length=60, nullable=false)
     */
    private $lastName = '';

    /**
     * Contains the street name of the shipping address
     *
     * @var string
     * @ORM\Column(name="street", type="string", length=255, nullable=false)
     */
    private $street = '';

    /**
     * Contains the zip code of the shipping address
     *
     * @var string
     * @ORM\Column(name="zipcode", type="string", length=50, nullable=false)
     */
    private $zipCode = '';

    /**
     * Contains the city name of the shipping address
     *
     * @var string
     * @ORM\Column(name="city", type="string", length=70, nullable=false)
     */
    private $city = '';

    /**
     * Contains the id of the country. Used for the shipping - country association.
     *
     * @var int
     * @ORM\Column(name="countryID", type="integer", nullable=false)
     */
    private $countryId = 0;

    /**
     * Getter function for the unique id identifier property
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter function for the company column property
     *
     * @param string $company
     *
     * @return Shipping
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Getter function for the company column property.
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Setter function for the department column property.
     *
     * @param string $department
     *
     * @return Shipping
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Getter function for the department column property.
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Setter function for the salutation column property.
     *
     * @param string $salutation
     *
     * @return Shipping
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Getter function for the salutation column property.
     *
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Setter function for the firstName column property.
     *
     * @param string $firstName
     *
     * @return Shipping
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Getter function for the firstName column property.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Setter function for the lastName column property.
     *
     * @param string $lastName
     *
     * @return Shipping
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Getter function for the lastName column property.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Setter function for the street column property.
     *
     * @param string $street
     *
     * @return Shipping
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Getter function for the street column property.
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Setter function for the zipCode column property.
     *
     * @param string $zipCode
     *
     * @return Shipping
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Getter function for the zipCode column property.
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Setter function for the city column property.
     *
     * @param string $city
     *
     * @return Shipping
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Getter function for the city column property.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Setter function for the countryId column property.
     *
     * @param $countryId
     *
     * @return Shipping
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Getter function for the countryId column property.
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Returns the instance of the Shopware\Models\Customer\Customer model which
     * contains all data about the customer. The association is defined over
     * the Customer.shipping property (INVERSE SIDE) and the Shipping.customer (OWNING SIDE) property.
     * The customer data is joined over the s_user.id field.
     *
     * @return \Shopware\Models\Customer\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Setter function for the customer association property which contains an instance of the Shopware\Models\Customer\Customer model which
     * contains all data about the customer. The association is defined over
     * the Customer.shipping property (INVERSE SIDE) and the Shipping.customer (OWNING SIDE) property.
     * The customer data is joined over the s_user.id field.
     *
     * @param \Shopware\Models\Customer\Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return \Shopware\Models\Attribute\CustomerShipping
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Shopware\Models\Attribute\CustomerShipping|array|null $attribute
     *
     * @return \Shopware\Models\Attribute\CustomerShipping
     */
    public function setAttribute($attribute)
    {
        return $this->setOneToOne($attribute, '\Shopware\Models\Attribute\CustomerShipping', 'attribute', 'customerShipping');
    }

    /**
     * @param int $stateId
     */
    public function setStateId($stateId)
    {
        $this->stateId = $stateId;
    }

    /**
     * @return int
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Setter function for the setAdditionalAddressLine2 column property.
     *
     * @param string $additionalAddressLine2
     */
    public function setAdditionalAddressLine2($additionalAddressLine2)
    {
        $this->additionalAddressLine2 = $additionalAddressLine2;
    }

    /**
     * Getter function for the getAdditionalAddressLine2 column property.
     *
     * @return string
     */
    public function getAdditionalAddressLine2()
    {
        return $this->additionalAddressLine2;
    }

    /**
     * Setter function for the setAdditionalAddressLine1 column property.
     *
     * @param string $additionalAddressLine1
     */
    public function setAdditionalAddressLine1($additionalAddressLine1)
    {
        $this->additionalAddressLine1 = $additionalAddressLine1;
    }

    /**
     * Getter function for the getAdditionalAddressLine1 column property.
     *
     * @return string
     */
    public function getAdditionalAddressLine1()
    {
        return $this->additionalAddressLine1;
    }

    /**
     * Transfer values from the new address object
     *
     * @param Address $address
     */
    public function fromAddress(Address $address)
    {
        $this->setCompany((string) $address->getCompany());
        $this->setDepartment((string) $address->getDepartment());
        $this->setSalutation((string) $address->getSalutation());
        $this->setFirstName((string) $address->getFirstname());
        $this->setLastName((string) $address->getLastname());
        $this->setStreet((string) $address->getStreet());
        $this->setCity((string) $address->getCity());
        $this->setZipCode((string) $address->getZipcode());
        $this->setAdditionalAddressLine1((string) $address->getAdditionalAddressLine1());
        $this->setAdditionalAddressLine2((string) $address->getAdditionalAddressLine2());
        $this->setCountryId($address->getCountry()->getId());
        $this->setTitle($address->getTitle());

        if ($address->getState()) {
            $this->setStateId($address->getState()->getId());
        } else {
            $this->setStateId(null);
        }

        $attributeData = Shopware()->Models()->toArray($address->getAttribute());
        $this->setAttribute($attributeData);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
