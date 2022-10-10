const Button = ({ text, onClick, color }) => {
    return (
      <button className="btn" onClick={onClick}>
        Sign-in
      </button>
    );
  };
  
  Button.defaultProps = {
    text: "default",
  };
  
  export default Button;