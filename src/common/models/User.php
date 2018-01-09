<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property string $username
 * @property string $role_name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property date $created_at
 * @property date $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%LOGIN}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['STATUS', 'default', 'value' => self::STATUS_ACTIVE],
            ['STATUS', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USERNAME' => 'Používateľské meno',
            'PASSWORD' => 'Heslo',
            'EMAIL'    => 'E-mail',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['USERNAME' => $id, 'STATUS' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['USERNAME' => $username, 'STATUS' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'PASSWORD_RESET_TOKEN' => $token,
            'STATUS' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->AUTH_KEY;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->PASSWORD_HASH);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->AUTH_KEY = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = null;
    }

    public static function findOperatorEmployees($idOperator)
    {
        $employeeQuery = (new Query())->select('USERNAME')->from('PERSON')
            ->join('LEFT JOIN', 'EMPLOYEE', 'PERSON.IDENTIFICATION_NUMBER = EMPLOYEE.IDENTIFICATION_NUMBER');

        return static::find()
            ->where(['ID_OPERATOR' => $idOperator])
            ->andWhere(['USERNAME' => $employeeQuery])
            ->all();
    }

    public static function getCountOfEmployees($idOperator)
    {
        $employeeQuery = (new Query())->select('USERNAME')->from('PERSON')
            ->join('LEFT JOIN', 'EMPLOYEE', 'PERSON.IDENTIFICATION_NUMBER = EMPLOYEE.IDENTIFICATION_NUMBER');

        return static::find()
            ->select(['COUNT(*) AS cnt'])
            ->where(['ID_OPERATOR' => $idOperator])
            ->andWhere(['USERNAME' => $employeeQuery])
            ->count();
    }

    public static function getCountOfCustomers($idOperator)
    {
        return static::find()
            ->select(['COUNT(*) AS cnt'])
            ->where(['ID_OPERATOR' => $idOperator])
            ->andWhere(['ROLE_NAME' => 'customer'])
            ->count();
    }

}
