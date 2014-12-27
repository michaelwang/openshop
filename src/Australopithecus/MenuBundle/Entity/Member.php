<?php

namespace Australopithecus\MenuBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * Member
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class Member extends BaseUser implements OAuthAwareUserProviderInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="customAccessToken", type="string", length=200)
     */
    private $customAccessToken = '';

    /**
     * @var string
     *
     * @ORM\Column(name="customId", type="string", length=200)
     */
    private $customId = '';
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct(UserManagerInterface $userManager = null)
    {
        parent::__construct();
        $this->userManager = $userManager;
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
#        $username = $response->getUsername();
#        var_dump($username);exit;
        $username = $response->getResponse()["username"];
        var_dump($username);
        $user = $this->userManager->findUserBy(array('username' => $username));
        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set' . ucfirst($service);
            $setter_id = $setter . 'Id';
            $setter_token = $setter . 'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($username);
        #    $user->setNickname($response->getNickName());
            $user->setEmail($username . '@yoursite.com');
            $user->setPassword($username);
        #    $user->setPath($response->getProfilePicture());
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return $user;
        }

        //if user exists - go with the HWIOAuth way
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        //update access token
        $user->$setter($response->getAccessToken());

        return $user;
    }

    /**
     * Set customAccessToken
     *
     * @param string $customAccessToken
     * @return Member
     */
    public function setCustomAccessToken($customAccessToken)
    {
        $this->customAccessToken = $customAccessToken;

        return $this;
    }

    /**
     * Get customAccessToken
     *
     * @return string 
     */
    public function getCustomAccessToken()
    {
        return $this->customAccessToken;
    }

    /**
     * Set customId
     *
     * @param string $customId
     * @return Member
     */
    public function setCustomId($customId)
    {
        $this->customId = $customId;

        return $this;
    }

    /**
     * Get customId
     *
     * @return string 
     */
    public function getCustomId()
    {
        return $this->customId;
    }
}
